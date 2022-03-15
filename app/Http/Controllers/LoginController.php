<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function auth(Request $request)
    {
        $userData = UserModel::where('users_username', $request->post('username'))
            ->first();
        if ($userData) {
            if (password_verify($request->post('password'), $userData->users_password)) {
                $this->setSessionLogin($userData);
                return redirect('/');
            }
        }
        session()->flash('loginFail', 'Password atau username salah');
        return back();
    }

    private function setSessionLogin($userData)
    {
        session()->put([
            "isLogin" => true,
            "userId" => $userData->users_id,
            "namaLengkap" => $userData->users_nama_lengkap
        ]);
    }
}
