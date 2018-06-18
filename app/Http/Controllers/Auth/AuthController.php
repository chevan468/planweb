<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:20|min:3',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|min:6|confirmed',
        ],[
            'name.required' => 'Debe ingresar un nombre',
            'name.max' => 'El nombre no debe contener más de 20 caractéres.',
            'name.min' => 'El nombre no debe contener menos de 3 caractéres.',
            
            'email.required' => 'Debe ingresar un correo',
            'email.unique' => 'El correo ya se encuentra registrado',
            'name.max' => 'El correo no puede contener más de 30 caractéres.',
            
            'password.required' => 'Debe ingresar una contraseña',
            'password.min' => 'La contraseña debe poseer mínimo 6 caractéres',
            'password.confirmed' => 'La contraseña y su confirmación no concuerdan.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
