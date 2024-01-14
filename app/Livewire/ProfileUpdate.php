<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ProfileUpdate extends Component
{

    public $user;
    public $name='';
    public $email='';

    public $password= '';


    public $newPassword = '';

    public $newPassword_confirmation = '';


    public function mount(){
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }


    public function update(){
        $this->validate([
            'name' => 'required|min:4|max:12',
            'email' => 'required|email',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('success','Profile updated successfully');
        return redirect()->route('blog');

    }


    public function updatePassword(){
        $this->validate([
            'password' => 'required',
            'newPassword' => 'required|min:8|confirmed',
            'newPassword_confirmation' => 'same:newPassword',
        ]);


        if(!Hash::check($this->password, $this->user->password)){
            return $this->addError('password', 'Password is incorrect');
        }

        $this->user->update([
            'password' => bcrypt($this->newPassword),
        ]);


        session()->flash('success','Password updated successfully');
        return redirect()->route('blog', true);

    }

    public function render()
    {
        return view('livewire.profile-update', [
            'user' => $this->user,
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
