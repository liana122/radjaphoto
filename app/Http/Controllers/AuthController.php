<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        
        
        if($request->remember===null){
            setcookie('email',$request->email,100);
            setcookie('password',$request->password,100);
        }else{
            setcookie('email',$request->email,time()+60*60*24*100);
            setcookie('password',$request->password,time()+60*60*24*100);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard.admin');
            }

            if (auth()->user()->role == 'user') {
                return redirect()->route('dashboard.user');
            }

            // if (auth()->user()->role == 'admin') {
            //     // dd(auth()->user()->role);
            //     return redirect(route('dashboard.admin'));
            // } elseif (auth()->user()->role == 'user') {
            //     return redirect(route('dashboard.user'));
            // }
            
        } else {
            return redirect('login')->with('error','');
        }

        // return redirect()->back();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function proses_register(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        DB::beginTransaction();
        try {
            //code...
            $folder = createMainDirectory($request->name);
            if($folder){
                $user = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'role'=>'user',
                    'password' => bcrypt($request->password)
                ];

                $result = User::create($user);

            }
            DB::commit();

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {    
                if (auth()->user()->role == 'admin') {
                    // dd(auth()->user()->role);
                    return redirect(route('dashboard.admin'));
                } elseif (auth()->user()->role == 'user') {
                    return redirect(route('dashboard.user'));
                }
            } else {
                return redirect('login')->with('error','');
            }

            return $result;
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
