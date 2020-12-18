<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
Use Alert;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        Alert::success(trans('auth.login_successfully'));

        if ($user->role_id == config('setting.admin_id')) {
            return redirect()->route('admin.products.index');
        } elseif ($user->role_id == config('setting.supplier_id')) {
            return redirect()->route('supplier.products.index');
        }

        return redirect()->route('home.index');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], Response::HTTP_NO_CONTENT)
            : redirect()->route('login');
    }
}
