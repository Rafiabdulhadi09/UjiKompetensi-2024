<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function index ()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ],[
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi'
        ]);
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if(Auth::attempt($infologin)){
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            }  if (Auth::user()->role == 'kasir') {
                return redirect('/kasir');
            }  if (Auth::user()->role == 'owner') {
                return redirect('/owner');
            }    
        }else{
            return redirect('')->withErrors('Username dan password yang anda masukan tidak sesuai')->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
