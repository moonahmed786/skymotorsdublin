<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagement extends Component
{
    use WithPagination, WithSorting;

    public $search = '';
    public $name, $email, $password, $role;
    public $userId;
    public $isEditing = false;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
            'password' => $this->isEditing ? 'nullable|min:8' : 'required|min:8',
            'role' => 'required|exists:roles,name',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset(['name', 'email', 'password', 'role', 'userId', 'isEditing']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()?->name;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->isEditing) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            $user->syncRoles([$this->role]);
            session()->flash('message', 'User updated successfully.');
        } else {
            $user = User::create($data);
            $user->assignRole($this->role);
            session()->flash('message', 'User created successfully.');
        }

        $this->showModal = false;
        $this->reset(['name', 'email', 'password', 'role', 'userId', 'isEditing']);
    }

    public function delete($id)
    {
        if ($id === auth()->id()) {
            session()->flash('error', 'You cannot delete yourself.');
            return;
        }

        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        $query = User::query()
            ->with('roles')
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.admin.user-management', [
            'users' => $query->paginate(10),
            'roles' => Role::all(),
        ])->layout('layouts.admin');
    }
}
