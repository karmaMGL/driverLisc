<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberLoginReg extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
