<?php

namespace Radiocubito\TallAuth\Http\Livewire;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Register extends Component
{
    use RegistersUsers;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'max:255',
            'email' => 'email|max:255',
            'password' => 'min:8',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }

    protected function validator()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:password_confirmation'],
        ]);
    }

    protected function create()
    {
        return User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    protected function redirectTo()
    {
        return RouteServiceProvider::HOME;
    }
}
