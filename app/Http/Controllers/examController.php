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
    public function getSections($examId){
        $section = Section::all();
        Log::info('where'.$examId);
        $page = view('staticExam.chooseExamSection',['sections'=>$section,'examId'=>$examId ]);
        return view('adminLayout.adminLayout',['sections'=>$page] );
    }
    public function getQuestsFromSection($sectionId,$examId){
        $quest = question::where('SectionIDSelected',$sectionId)->get();
        $selectedQuestIDs =json_decode(ExamPrep::find($examId)->selectedQuestIDs,true);
        $overly = view('staticExam.addStaticExam',['quests'=>$quest,'examId'=>$examId ,'selectedQuestIDs'=>$selectedQuestIDs ]);
        return view('adminLayout.adminLayout',['content'=> $overly]);
    }

    public function AddQuestToTempTable($QuestId,$examId)
    {
        $data = ExamPrep::find($examId);// -------------------- this needs a work (logical)

        if( !empty($data) ){
            //$data->name = Auth::guard('Admin')->user()->email;
            //$question = question::find($QuestId);
            $oldData = json_decode($data->selectedQuestIDs);
            Log::info($oldData);
            $oldData[] =  question::find( $QuestId)->id;
            $data->selectedQuestIDs = json_encode($oldData );
            $data->adminID = Auth::guard('Admin')->id();
            $data->save();
        }

        return redirect()->back();
    }
    public function removeQuestFromTempTable($QuestId,$examId){
        $data = ExamPrep::find($examId);// -------------------- this needs a work (logical)

        if( !empty($data) ){
            $selectedId = json_decode(ExamPrep::find($examId)->selectedQuestIDs);
            unset($selectedId[array_search($QuestId,$selectedId)]);
            //$data->name = Auth::guard('Admin')->user()->email;
            //$question = question::find($QuestId);

            $data->selectedQuestIDs = json_encode($selectedId );
            $data->adminID = Auth::guard('Admin')->id();
            $data->save();
        }

        return redirect()->back();
    }
}
