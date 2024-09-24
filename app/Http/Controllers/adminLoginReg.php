<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminLoginReg extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function AdminLoginPage(){
        return view('adminLoginReg.adminLogin');
    }
    public function adminLoginFunc(Request $request){
        $data = $request->only('email','password');
        if(Auth::guard('Admin')->attempt($data)){
            return redirect('/adminDashboard');
        }
        return back()->withErrors('error','Something went wrong');
    }
    public function addAdmin(){
        $data = new Admin;
        $data->email = 'a@gmail.com';
        $data->password = '123123123';
        $data->phoneNumber = "99999999";
        $data->save();
        return redirect('/adminLoginPage');
    }
    public function show(Admin $admin)
    {
        //
    }


}
