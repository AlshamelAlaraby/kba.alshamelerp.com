<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Modules\Admin\AuthLibrary;
use App\Modules\Admin\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Backend\BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/backend';
    protected $authLibrary;

    public function __construct(AuthLibrary $authLibrary)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->authLibrary = $authLibrary;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!$this->authLibrary->login($request->all())) {
            return redirect()->back()->with('alert-danger','Email or password not correct');
        }
        return redirect()->route('backend.home')->with('alert-success','Logged in successfully');
    }

    protected function loggedOut()
    {
        return redirect()->route('backend.show.login.form');
    }

}
