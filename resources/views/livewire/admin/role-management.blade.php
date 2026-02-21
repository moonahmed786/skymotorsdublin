<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-slate-800">Role Management</h2>
                    <button wire:click="create"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Add Role
                    </button>
                </div>

                <!-- Messages -->
                @if (session()->has('message'))
                    <div
                        class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg relative mb-6 flex items-center shadow-sm">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('message') }}</span>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div
                        class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-lg relative mb-6 flex items-center shadow-sm">
                        <svg class="w-5 h-5 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Roles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($roles as $role)
                        <div class="border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow bg-slate-50">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-bold text-slate-800">{{ $role->name }}</h3>
                                <div class="flex space-x-2">
                                    <button wire:click="edit({{ $role->id }})"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</button>
                                    @if($role->name !== 'Super Admin')
                                        <button wire:click="delete({{ $role->id }})" wire:confirm="Delete this role?"
                                            class="text-rose-600 hover:text-rose-800 text-sm font-semibold transition-colors">Delete</button>
                                    @endif
                                </div>
                            </div>
                            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Permissions
                            </div>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($role->permissions as $permission)
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-md bg-white border border-slate-200 text-slate-600">
                                        {{ $permission->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-slate-400 italic">No permissions assigned</span>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true"
                    wire:click="$set('showModal', false)"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-slate-100">
                        <h3 class="text-lg leading-6 font-bold text-slate-900" id="modal-title">
                            {{ $isEditing ? 'Edit Role' : 'Create Role' }}
                        </h3>
                        <div class="mt-6 space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Role Name</label>
                                <input type="text" wire:model="name"
                                    class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-3">Permissions</label>
                                <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                                    @foreach($groupedPermissions as $group => $permissions)
                                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                            <h4
                                                class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 border-b border-slate-200 pb-2">
                                                {{ ucfirst($group) }} Management
                                            </h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                                @foreach($permissions as $permission)
                                                    <label class="inline-flex items-center group cursor-pointer">
                                                        <input type="checkbox" wire:model="selectedPermissions"
                                                            value="{{ $permission->name }}"
                                                            class="rounded border-slate-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition ease-in-out duration-150">
                                                        <span
                                                            class="ml-2 text-sm text-slate-600 group-hover:text-slate-900 transition-colors">
                                                            {{ ucwords(str_replace('.', ' ', $permission->name)) }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" wire:click="store" wire:loading.attr="disabled"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove target="store">Save</span>
                            <span wire:loading target="store">Saving...</span>
                        </button>
                        <button type="button" wire:click="$set('showModal', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>