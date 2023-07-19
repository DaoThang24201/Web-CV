<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\RegisteringRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registering(RegisteringRequest $request)
    {
        $password = Hash::make($request->password);
        $role = $request->role;

        if (auth()->check()) {
            User::query()->where('id', auth()->user()->id)->update([
                'password' => $password,
                'role' => $role,
            ]);
        } else {
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
            ]);
            Auth::login($user);
        }

    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $data = Socialite::driver($provider)->user();

        $user = User::query()->where('email', $data->getEmail())->first();
        $checkExist = true;

        if (is_null($user)) {
            $user = new User();
            $user->email = $data->getEmail();
            $checkExist = false;
        }

        $user->name = $data->getName();
        $user->avatar = $data->getAvatar();
        $user->save();

        Auth::login($user);

        if ($checkExist) {
            $role = strtolower(UserRoleEnum::getKeys($user->role)[0]);

            return redirect()->route("$role.welcome");
        }
        return redirect()->route('register');
    }
}
