<?php


namespace Rfof\Auth\Service;


use Illuminate\Support\Facades\Auth;

class AuthService
{
    use AuthenticateUsers;

    public $model;
    public $guard;
    public $username;
    public $usernameAttribute;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public static function for($model)
    {
        return new static($model);
    }

    public function useGuard($guard)
    {
        $this->guard = $guard;
        return $this;
    }

    public function useUserName($username)
    {
        $this->username = $username;
        return $this;
    }

    public function username()
    {
        return $this->username;
    }

    public function getUserNameAttribute()
    {
        return $this->usernameAttribute ?: $this->username;
    }

    protected function model()
    {
        return $this->model;
    }

    protected function getGuard()
    {
        return $this->guard;
    }

    private function getUser($username)
    {
       return $this->model()::where('mobile', $username)->first() ??
            $this->model()::where('email', $username)->first();
    }
}
