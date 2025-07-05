<div>
    {{-- <h1>{{ $title }}</h1>

    {{ count($users) }}

    <button wire:click="createNewUser">
        Create New User
    </button> --}}

    <form wire:submit="createNewUser" action="">
        <input wire:model="name" type="text" placeholder="name">
        <input wire:model="email" type="email" name="" id="" placeholder="email">
        <input wire:model="password" type="password" placeholder="password">

        {{-- <button wire:click.prevent='createNewUser'>Create</button> --}}
        <button>Create</button>
    </form>

    <hr>

    @forelse ($users as $user)
        <h3>{{ $user->name }}</h3>
    @empty
        <h3>Empty</h3>    
    @endforelse
</div>
