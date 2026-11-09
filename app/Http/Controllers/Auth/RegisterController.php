<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm()
    {
        $roles = Role::all();

        return view('auth.register', compact('roles'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        if (
            $user->role &&
            strtolower($user->role->name) === 'admin'
        ) {

            return route(
                'chat.support.index'
            );

        }

        return '/interest';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {
        if (empty($data['role_id'])) {

            $userRole = Role::where('name', 'user')->first();

            $roleId = $userRole->role_id;

        } else {

            $roleId = $data['role_id'];
        }

        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'role_id' => $roleId,
            'password' => Hash::make($data['password']),
        ]);
    }
}
