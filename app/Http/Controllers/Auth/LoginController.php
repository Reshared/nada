<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('nada');
    }

    /**
     * return success
     * @param $request
     * @param $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        return response()->json(['msg' => 'success']);
    }

    /**
     * return json response
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loggedOut($request)
    {
        return response()->json(['msg' => '退出成功']);
    }
}
