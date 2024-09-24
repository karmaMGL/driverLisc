<?php

namespace App\Http\Controllers;

use App\Charts\TestChart;
use App\Models\question;
use App\Models\Section;
use App\Models\Member;
use App\Models\performance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use function PHPUnit\Framework\isEmpty;

class MemberPages extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $Counts = [];
        $SectionNumber = [];
        $names = [];
        $questions = question::all();

        foreach(Section::all() as $SectionOne){
            $SectionNumber[] = $SectionOne->SectionNumber;
            $Counts[] = $questions->where('SectionIDSelected',$SectionOne->id)->count();
            $names[] = $SectionOne->title;
        }

        return view("websiteMainFiles.index",['MatchSection'=>$SectionNumber,'QuestionCounts'=>$Counts,'Title'=>$names]);
    }
    public function SectionsPage(){
        $Counts = [];
        $SectionNumber = [];
        $names = [];
        $questions = question::all();

        foreach(Section::all() as $SectionOne){
            $SectionNumber[] = $SectionOne->SectionNumber;
            $Counts[] = $questions->where('SectionIDSelected',$SectionOne->id)->count();
            $names[] = $SectionOne->title;
        }

        return view("websiteMainFiles.courses",['MatchSection'=>$SectionNumber,'QuestionCounts'=>$Counts,'Title'=>$names]);
    }
    public function openSectionPage($SectionNumber){
        $dataSec = Section::where('SectionNumber','like',$SectionNumber)->first();
        $id = $dataSec->id;
        $data = question::where('SectionIDSelected','like',$id)->get();
        $secID = $dataSec->id;
        return view('QuestTestPages/openedSection',['datas' => $data,'SectionID'=>$secID]);
    }
    // public function openTestPage($SectionNumber,$questId){
    //     return view('QuestTestPages.openTest');
    // }
    public function Dashboard() {
        $id = Auth::guard('Member')->user()->id;
        $datas = Member::where('id', $id)->first();
        $performaneOfmember = performance::where('userID',$id)->get();
        $data = [];
        Log::info($performaneOfmember);
        foreach($performaneOfmember as $per){
            $data[] = ['label'=>$per->testTakenDate, 'value'=>$per->correctAnswered];

        }

        // $data = [
        //     ['label' => 'A', 'value' => 30],
        //     ['label' => 'B', 'value' => 80],
        //     ['label' => 'C', 'value' => 45],
        //     ['label' => 'D', 'value' => 60],
        //     ['label' => 'E', 'value' => 20],
        //     ['label' => 'F', 'value' => 90],
        //     ['label' => 'G', 'value' => 55]
        // ];

        return view('MembersPages.Dashboard', ["userData" => $datas,'data'=>$data]);
    }




    public function clickedCorrectAnswer(Request $request , $id,$sectionID) {
        $member = Auth::guard('Member')->user();
        $today = Carbon::now()->format('Y-m-d');
        $Checkk = performance::where('userID',$member->id)->where('testTakenDate',$today)->first();
        Log::info($Checkk);

        if($Checkk){
            $num = $Checkk->correctAnswered;
            $Checkk->correctAnswered = $num +1;
            $Checkk->save();
        }
        else
        {
            $newData = new performance;
            $newData->userID = $member->id;
            $newData->testTakenDate =  $today;
            $num = $newData->correctAnswered;
            $newData->correctAnswered = $num +1;
            $newData->sectionID = $sectionID;
            $newData->save();
        }

        return response()->json([
            'message' => 'Correct answer recorded',
            'status' => 'success'
        ]);
    }

    public function clickedInCorrectAnswer(Request $request,$id,$sectionID) {

        $member = Auth::guard('Member')->user();
        $today = Carbon::now()->format('Y-m-d');
        $Checkk = performance::where('userID',$member->id)->where('testTakenDate',$today)->first();

        if($Checkk){
            $num = $Checkk->inCorrectAnswered;
            $Checkk->inCorrectAnswered = $num +1;
            $Checkk->save();
        }
        else
        {
            $newData = new performance;
            $newData->userID = $member->id;
            $newData->testTakenDate =  $today;
            $num = $newData->inCorrectAnswered;
            $newData->inCorrectAnswered = $num +1;
            $newData->sectionID = $sectionID;
            $newData->save();
        }
        // if ($member) {
        //     $member->total_incorrect_answered += 1;
        //     $member->save();
        // }

        return response()->json([
            'message' => 'Incorrect answer recorded',
            'status' => 'error'
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}