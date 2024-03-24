<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Hash;


class UserController extends Controller
{
    public function RegPost(Request $request)
    {
        $request->validate([
            'name'                  =>"required|min:4|max:30|unique:users,name",
            'email'                 =>"required|email|unique:users,email",
            'password'              =>["required","confirmed", Password::min(8)
                                                                        ->letters()
                                                                        ->mixedCase()
                                                                        ->numbers()
                                                                        ->symbols()
                                                                        ->uncompromised()],
                                                                        //
            'password_confirmation' =>"required",
            'birth'                 =>"required|date|before:now"
        ],[
            "name.required"                 =>"A felhasználónév megadása kötlező!",
            "name.min"                      =>"A felhasználónév minimum hossza 4 karakter!",
            "name.max"                      =>"A felhasználónév Maximum hossza 30 karakter!",
            "name.unique"                   =>"Ez a felhasználónév már foglalt!",

            "email.required"                =>"A Email cím megadása kötlező!",
            "email.email"                   =>"Nem megfelelő Email cím formátum!",
            "email.unique"                  =>"Ezzel az Email címmel már regisztráltak!",

            "password.required"             =>"A jelszó megadása kötlező!",
            "password.confirmed"            =>"A jelszavak nem egyeznek!",
            "password"                      =>"A jelszó nem elég erős!",

            "password_confirmation.required"=>"A jelszó megerősítése kötlező!",

            "birth.required"                =>"A születési dátum megadása kötlező!",
            "birth.before"                  =>"A születési dátum múltbelinek kell lennie!"
        ]);

        $data = new User();
        $data->name         = $request->name;
        $data->email        = $request->email;
        $data->password     = Hash::make($request->password);
        $data->color        = 0;
        $data->gender       = $request->option;
        $data->birth        = $request->birth;
        $data->profil_pic  = 0;

        $data->save();
        return redirect('/belepes');
    }

    public function LoginPost(Request $request)
    {
        $request->validate([
            'credential' =>"required",
            'password' =>"required"
        ],[
            "credential.required"=>"A mező nem lehet üres",
            "password.required"=>"A mező nem lehet üres"
        ]);
        $credential = $request->credential;
        $password = $request->password;
        if(Auth::attempt(['email' => $credential, 'password' => $password]))
        {
            return redirect('/');
        }
        else if(Auth::attempt(['name' => $credential, 'password' => $password]))
        {
            return redirect('/');
        }
        else
        {
            return redirect('/belepes')->withErrors(['msg'=>"Nem sikerült belépni"]);
        }
    }


    public function Logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function Profil()
    {
        if(Auth::check()){
            return view('profile',[
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'color' => Auth::user()->color,
                'gender' => Auth::user()->gender,
                'birth' => Auth::user()->birth,
                'profil_pic' => Auth::user()->profil_pic
            ]);
        }
        else{
            return redirect('/');
        }
    }

    public function Mod()
    {
        if(Auth::check()){
            return view('modositas',[
                'color'    =>Auth::user()->color,
                'gender'    =>Auth::user()->gender,
                'birth'    =>Auth::user()->birth,
                'profile_pic'    =>Auth::user()->profile_pic
            ]);
        }
        else{
            return redirect('/');
        }
    }
    public function ModData(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'birth'      =>"required|date|before:now",
            ],[
                "birth.required"=>"A születési dátum megadása kötlező!",
                "birth.before"  =>"A születési dátum múltbelinek kell lennie!",

            ]);
            if($request->profile_pic<>''){
                $request->validate([
                    'profile_pic'=>"active_url"
                ],[
                    "profile_pic.active_url"=>"A kép linkjét add meg!"
                ]);
            }
            $data = User::find(Auth::user()->id);
            if($request->color<>''){
                $data->color=$request->color;
            }
            else {
                $data->color=0;
            }
            $data->gender=$request->option;
            $data->birth=$request->birth;
            $data->profil_pic=$request->profile_pic;
            $data->save();
            return redirect('/mod')->witherrors([
                'alert' => 'sikeres módosítás!'
            ]);
        }
        else{
            return redirect('/');
        }
    }
    public function Pass()
    {
        if(Auth::check()){
            return view('jelszo');
        }
        else{
            return redirect('/');
        }
    }

    public function PassData(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'old'=>'required',
                'password'=>'required',
                'password_confirmation'=>'required'
            ],[
                'old.required'=>'A mező nem lehet üres!',
                'password.required'=>'A mező nem lehet üres!',
                'password_confirmation.required'=>'A mező nem lehet üres!'
            ]);
            if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old])){
                $request->validate([
                    'password'=>['required','confirmed',Password::min(8)
                                                    ->letters()
                                                    ->mixedCase()
                                                    ->numbers()
                                                    ->symbols()
                                                    ->uncompromised()],
                    'password_confirmation'=>'required'
                ],[
                    'old.required'=>'A mező nem lehet üres!',
                    'password.required'=>'A mező nem lehet üres!',
                    'password_confirmation.required'=>'A mező nem lehet üres!'
                ]);
                $data = User::find(Auth::user()->id);
                $data ->password = Hash::make($request->password);
                $data->save();
                return redirect('/jelszomod')->witherrors(['success'=>'Sikeres jelszó módosítás!']);
            }
            else{
                return redirect('/jelszomod')->witherrors(['alert'=>'Érvénytelen a régi jelszó']);
            }
        }
        else{
            return redirect('/');
        }
    }

    public function Alert()
    {
        if(Auth::check()){
            return view('alert',[
                'name' => Auth::user()->name
            ]);
        }
        else{
            return redirect('/');
        }
    }

    public function Del()
    {
        if(Auth::check()){
            $data = User::find(Auth::user()->id);
            $data->delete();
            Auth::logout();
            return redirect('/');
        }
        else{
            return redirect('/');
        }
    }
}
