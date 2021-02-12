<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class firstController extends Controller
{
    //
    // public function aut(Request $req)
    // {
    //     # code...
    //     $cred = $req->only('email', 'password');
    //     if (Auth::attempt($cred)) {
    //         $req->session()->regenerate();
    //         return redirect()->intended('index');
    //     }
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }


    public function func(Request $request)
    {
            // return dd($request->only('email', 'password'));
            if (Auth::attempt($request->only('email', 'password'))) {
                $ev = DB::table('events')->where('organizer_id',Auth::id())->get();
                return view('index',['eve'=>$ev])->with('info', "Зарегестрированы");
            }
            return back()->with("info", "Неправильный логин или пароль ");
            
    }
}
