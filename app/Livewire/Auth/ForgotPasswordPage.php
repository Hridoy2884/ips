<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Password;






#[Title('Forgot Password')]


class ForgotPasswordPage extends Component
{

    public $email;

    //forgot password method
    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link sent to your email.');
            $this->email = '';
            
        }

        // Here you would typically send a password reset link to the user's email
        // For demonstration, we'll just flash a success message
        session()->flash('success', 'Password reset link sent to your email.');
  




     
    }
    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
