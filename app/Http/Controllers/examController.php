<?php

namespace App\Http\Controllers;

use App\Models\ExamPrep;
use App\Models\question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class examController extends Controller
{
    //
    public function examOverview(){
        $data = ExamPrep::all();
        $overlay = view('staticExam.examOverview',['exams'=>$data ]);
        return view('adminLayout.adminLayout',['content'=>$overlay]);
    }
    public function createExam(Request $request){
        $newdata = new ExamPrep();
        $newdata->name = $request->name;
        $newdata->selectedQuestIDs = null;
        $newdata->adminID = Auth::guard('Admin')->id();
        $newdata->save();
        return redirect()->back();
    }
    public function getSections(){
        $section = Section::all();

        $page = view('staticExam.chooseExamSection',['sections'=>$section]);
        return view('adminLayout.adminLayout',['sections'=>$page] );
    }
    public function getQuestsFromSection(){
        $quest = question::all();
        $overly = view('staticExam.addStaticExam',['quests'=>$quest]);
        return view('adminLayout.adminLayout',['content'=> $overly]);
    }

    public function AddQuestToTempTable(Request $request,$id)
    {
        $data = ExamPrep::find(Auth::guard('Admin')->id());// -------------------- this needs a work (logical)
        if(isEmpty($data)){
            Log::info('not Found data');
            $newdata = new ExamPrep();
            $newdata->name = $request->name;
            $question = question::find($id);
            $newdata->selectedQuestIDs = json_encode($question->id );
            $newdata->adminID = Auth::guard('Admin')->id();
            $newdata->save();
        }
        else{
            Log::info('Founded old data');
            if( $data->isFinished == true){
                $data->name = $request->name;
                $question = question::find($id);
                $oldData = json_decode($data->selectedQuestIDs);
                $oldData[] =  question::find($id);
                $data->selectedQuestIDs = json_encode($question->id );
                $data->adminID = Auth::guard('Admin')->id();
                $data->save();
            }
        }
        return redirect()->back();
    }
    public function removeQuestFromTempTable($id){
        return redirect()->back();
    }
}
