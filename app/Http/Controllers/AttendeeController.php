<?php

namespace App\Http\Controllers;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AttendeeController extends Controller
{
    //
    public function login(Request $request)
    {
      $val =   $request->validate([
            'lastname'=>'required',
           'registration_code'=>'required'
        ]);
        // $ai = Attendee::where('id', '>', 4)->update(['login_token' => Hash::make(Str::random(80))]);
        // $ai->login_token = ;
        // $ai->save();
        // LOGIN_TOKEN добавление
        $api = Attendee::where('lastname', $request->lastname)->where('registration_code', $request->registration_code)->first();

        if (!$api) {
            return response()->json(['message'=>'неверный логин или пароль'],401);
        }
        $api->login_token = Hash::make(Str::random(80));
        $api->save();
      
        // ВЫТАЩИТЬ ATTENDEE
        return response()->json($api);
    
// // ПОСЛЕ ПРИСВОЕНИЯ API_TOKEN ВЫВЕСТИ ВСЮ ИНФОРМАЦИЮ О ПОЛЬЗОВАТЕЛЕ
// // eloquent -> модель

//         # code...
    }

    public function logout(Request $request)
    {
       
        $api = Attendee::where('login_token', $request->Token)->first();
        if (!$api) {
            return response()->json(['message'=>'not found token'],401);
        }

        $api->login_token = '';
        $api->save();
        return response()->json(['message'=>'you are out!!!'],200);
        // # code...
    }
}
