<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleManagement extends Component
{
    public $name;
    public $selectedPermissions = [];
    public $roleId;
    public $isEditing = false;
    public $showModal = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->roleId)],
            'selectedPermissions' => 'array',
        ];
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'selectedPermissions', 'roleId', 'isEditing']);
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $role = Role::with('permissions')->findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        if ($this->isEditing) {
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', 'Role updated successfully.');
        } else {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);
            session()->flash('message', 'Role created successfully.');
        }

        $this->showModal = false;
        $this->reset(['name', 'selectedPermissions', 'roleId', 'isEditing']);
    }

    public function delete($id)
    {
        if ($id == 1) { // Prevent deleting Super Admin
            session()->flash('error', 'Cannot delete Super Admin role.');
            return;
        }

        Role::findOrFail($id)->delete();
        session()->flash('message', 'Role deleted successfully.');
    }

    public function render()
    {
        $permissions = Permission::all();
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('livewire.admin.role-management', [
            'roles' => Role::with('permissions')->get(),
            'groupedPermissions' => $groupedPermissions,
        ])->layout('layouts.admin');
    }
}
