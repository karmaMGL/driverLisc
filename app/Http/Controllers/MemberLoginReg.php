<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberLoginReg extends Controller
{

    public function loginPage(){
        return view('MemberLoginReg/Login');
    }
    public function loginFunc(Request $request){
        $val = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ],[
            'email.email'=>'Таны имэйл @gmail.com гэж төгсөх ёстой',
            'password.min'=>'Нууц үг хамгийн багадаа 8 тэмдэгттэй байх ёстой',
        ]);
        $cred =$request->only('email','password');
        Log::info($cred);
        if(Auth::guard('Member')->attempt($cred)){
            return redirect('/DashboardM');
        }
        return back()->withErrors(['Error'=>'Имэйл эсвэл нууц үг буруу байна']);

    }
    public function logout(){
        if(Auth::guard('Member')->check())Auth::guard('Member')->logout();
        if(Auth::guard(name: 'Admin')->check())Auth::guard('Admin')->logout();

        return redirect('/');
    }
    public function registerPage(){
        return view('MemberLoginReg/Register');
    }
    public function registerFunc(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:members,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Энэ имэйл аль хэдийн бүртгэгдсэн байна', // Custom error message
            'password.min' => 'Нууц үг хамгийн багадаа 8 тэмдэгттэй байх ёстой',
        ]);

        $newAcc = new Member;
        $newAcc->name = $request->name;
        $newAcc->email = $request->email;
        $newAcc->password = $request->password;
        $newAcc->save();


        return redirect()->route('login')->with('success', "Account has been successfully created");
    }

}
