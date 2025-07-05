<div class="max-w-lg mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg space-y-8">

    <h1>User Registration</h1>

    {{-- <h1>{{ $title }}</h1>

    {{ count($users) }}

    <button wire:click="createNewUser">
        Create New User
    </button> --}}
    @if (session('success'))
        <div class="px-4 py-3 text-white bg-green-500 rounded-lg text-sm font-medium shadow">
            {{ session('success') }}
        </div>
    @endif

    <form class="space-y-4" wire:submit="createNewUser">
        <div>
            <input
                class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 px-4 py-2 text-sm"
                wire:model="name"
                type="text"
                placeholder="Name"
            >
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input
                class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 px-4 py-2 text-sm"
                wire:model="email"
                type="email"
                placeholder="Email"
            >
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input
                class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 px-4 py-2 text-sm"
                wire:model="password"
                type="password"
                placeholder="Password"
            >
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- <button wire:click.prevent='createNewUser'>Create</button> --}}
        <button
            class="flex w-full rounded-lg px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition shadow-sm"
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
            <span class="ml-2">Create User</span>
        </button>
    </form>

     <div>
        <svg style="position: absolute; margin-top: 13px; margin-left: 9px;" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="11" cy="11" r="7" stroke-width="2" />
            <line x1="16.5" y1="16.5" x2="21" y2="21" stroke-width="2" stroke-linecap="round" />
        </svg>
        <input
            class="block w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 px-6 py-2 text-sm"
            wire:model.live.debounce.600ms="search"
            type="text"
            placeholder="Searching..."
        >
    </div>

    <div class="bg-gray-50 p-6 rounded-xl shadow-inner space-y-3">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Users </h2>

        <div class="space-y-2">
            @forelse ($users as $user)
                <div wire:key="{{ $user->id }}" class="px-4 py-2 bg-white rounded-md shadow text-gray-800">
                    <div class="flex justify-between">
                        <div class="flex">
                            @if ($user->verified)
                                <input wire:click="toggle({{ $user->id }})" class="mr-2" type="checkbox">                                    
                            @else
                                <input wire:click="toggle({{ $user->id }})" class="mr-2" type="checkbox">                                    
                            @endif
                            @if ($editingUserId === $user->id)
                                <input 
                                    class="bg-gray-100 text-gray-900 text-sm rounded block w-full p-2.5"
                                     wire:model="editingUserName" type="text">
                                @error('newName')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            @else
                                <p>{{ $user->name }}</p>
                            @endif
                        </div>
                        <div>
                            <button wire:click="edit({{ $user->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 21l1-4 11-11 4 4-11 11-4 1zM14 7l3 3" />
                                </svg>
                            </button>
                            <button wire:click="deleteUser({{ $user->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4h6v3M4 7h16l-1 14H5L4 7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <span class="text-xs">{{ $user->created_at }}</span>
                    @if ($editingUserId == $user->id)
                        <div class="mt-3 text xs text-gray-700">
                            <button 
                                wire:click="update"
                                class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-900">Update</button>
                            <button 
                                wire:click="cancelEdit"
                                class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-900">Cancel</button>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 italic">Nenhum usuário encontrado.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $users->links('vendor.livewire.custom-pagination') }}
        </div>
    </div>

</div>
