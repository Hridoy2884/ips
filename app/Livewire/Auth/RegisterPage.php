<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    //register method
    public function save(){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|',
        ]);

        //save to database
        $user =User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        //login user
        auth()->login($user);

        //redirect to home
        return redirect()->intended();

        
    }
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
