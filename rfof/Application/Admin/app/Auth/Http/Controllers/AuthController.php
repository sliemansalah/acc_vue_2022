<?php

namespace Rfof\Admin\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Rfof\Domain\Admin\Auth\Model\Admin;
use Rfof\Domain\Core\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $admin['token'] = $admin->createToken('web')->plainTextToken;

        return Response::success(['admin' => $admin->makeHidden('token'), 'token' => $admin['token']])->withMessage('Logged In.')->send();

    }

    public function logout()
    {
        \request()->user()->tokens()->delete();
        return Response::success()->withMessage('logout Successfully')->send();
    }
}
