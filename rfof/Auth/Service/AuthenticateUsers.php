<?php


namespace Rfof\Auth\Service;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rfof\Domain\Core\Response;

trait AuthenticateUsers
{
    public function login(Request $request)
    {
        $user = $this->getUser($request->input($this->getUserNameAttribute()));
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendFailedLoginResponse($request);
        }

        if ($token = $user->createToken($request->userAgent())->plainTextToken) {
            return $this->sendLoginResponse($user, $token);
        }
    }

    public function logout()
    {
        return \request()->user($this->guard)->tokens()->delete();
    }

    protected function sendLoginResponse($user, $token)
    {
        return Response::success(['user' => $user->makeHidden('seller_id'), 'token' => $token])->withMessage('Logged In.')->send();
    }

    protected function sendFailedLoginResponse($request)
    {
        return Response::error(422, [$this->username() => 'Invalid ' . $this->username()])->withMessage('Invalid username or password.')->send();
    }
}
