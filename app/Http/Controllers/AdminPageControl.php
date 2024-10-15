<?php
namespace App\Http\Controllers;

use App\Models\question;
use App\Models\roadSign;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function QuestionAddPage(){
        $webdata = view('adminPages.addQuestion',['data'=>Section::all()]);
        return view('adminLayout.adminLayout',['content'=>$webdata]);
    }
    public function SectionAddPage(){
        $webdata = view('adminPages.addSection');
        return view('adminLayout.adminLayout',['content'=>$webdata]);
    }
    /**
     * Show the form for creating a new resource.
     */


    public function adminDAshboard(){
        if(Auth::guard('Admin')->check() == true){

            $content = view('adminDashboard.adminDashboard');
            return view('adminLayout.adminLayout',['content'=>$content]);
        }
        else{
            return redirect('/adminLoginPage');

        }
    }
    public function questionOverviewPage(){
        $section = Section::all();

        $page = view('editPages.questionOverview',['sections'=>$section]);
        return view('adminLayout.adminLayout',['content'=>  $page ]);
    }
    public function overviewRoadSigns(){
        $data = roadSign::all();
        $layout = view('roadSign.roadSignOverview' , ['roadSigns'=>$data]);
        return view('adminLayout.adminLayout',['content'=>$layout]);
    }
    public function addRoadSignPage(){
        $layout = view('roadSign.addRoadSign');
        return view('adminLayout.adminLayout',['content'=>$layout]);
    }
    public function editRoadSignPage($id){
        return view('',['id'=>$id]);
    }

}
