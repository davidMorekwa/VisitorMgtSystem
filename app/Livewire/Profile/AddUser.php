<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddUser extends Component
{
    #[Validate('required')]
    #[Validate('regex:/^[a-zA-Z]/', message: "Ivalid character in name")]
    public $name;
    #[Validate('required')]
    public $email;
    #[Validate('required|min:8')]
    public $password;
    #[Validate('required|confirmed|min:8')]
    public $password_confirmation;
    #[Validate('required')]
    public $role_id;

    public function handleUserAdd(){
        $this->validate();
        User::create([
            
        ]);
    }

    public function render()
    {
        return view('livewire.profile.add-user');
    }
}
