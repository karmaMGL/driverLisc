<?php

namespace App\Http\Controllers;

use App\Models\roadSign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class roadSignController extends Controller
{
    public function uploadSign(Request $request){
        $data = new roadSign();
        $data->name = $request->name;
        $file = $request->file("photo");
        $fileName = "roadSigns/".time().$file->getClientOriginalName();
        $file->move(public_path("roadSigns"),$fileName);
        Log::info($request->file("photo"));
        $data->imagePath =$fileName;
        $data->meaning = $request->explanation;
        $data->save();
        return redirect()->back()->with("success","success");
    }
    public function deleteRoadSign($id){
        $data = roadSign::find($id);
        $data->delete();
        return view('',['id'=>$id]);
    }
}
