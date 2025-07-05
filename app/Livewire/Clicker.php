<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{

    use WithPagination;

    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|min:5')]
    public $password;

    public $search;

    public $editingUserId;

    public $editingUserName;

    public function createNewUser()
    {

        // $this->validate([
        //     'name' => 'required|min:2|max:50',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:5'
        // ]);

        $validated = $this->validate();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $this->reset(['name', 'email', 'password']);

        session()->flash('success', 'User created sucess!');

        $this->resetPage();

    }

    public function deleteUser(User $user)
    {

        $user->delete();

    }

    public function toggle(User $user)
    {

        $user->verified != $user->verified; 

        $user->save();

    }

    public function edit(User $user)
    {

        $this->editingUserId = $user->id;

        $this->editingUserName = $user->name;

    }

    public function cancelEdit()
    {
        
        $this->reset('editingUserId', 'editingUserName');

    }

    public function update()
    {

        $this->validateOnly('editingUserName');

        User::find($this->editingUserId)->update([
            'name' => $this->editingUserName
        ]);

        $this->cancelEdit();

    }

    public function render()
    {

        // $title = "Users here!";

        return view('livewire.clicker', [
            "users" => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(3)
        ]);

    }

}
