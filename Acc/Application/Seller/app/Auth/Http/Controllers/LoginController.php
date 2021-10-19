<?php


namespace Acc\Seller\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Acc\Auth\Service\AuthService;
use Acc\Domain\Core\Response;
use Acc\Domain\Seller\Stores\Models\Store;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        return AuthService::for(User::class)
            ->useUserName('name')
            ->login($request)
            ->send();
    }

    public function storeLogin(Request $request)
    {
        return AuthService::for(Store::class)
            ->useUserName('username')
            ->login($request);
    }

    public function logout()
    {
        AuthService::for(Store::class)
            ->useGuard('store')
            ->logout();

        return Response::success()->withMessage('Logout Successful')->send();
    }
}