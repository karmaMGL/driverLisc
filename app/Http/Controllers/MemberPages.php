<?php

namespace App\Http\Controllers;

use App\Charts\TestChart;
use App\Models\examPerformance;
use App\Models\ExamPrep;
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
    // ---------------------------------------------------------------------> exam stuffs
    public function examSectionPage(){
        $exams = ExamPrep::all();
        return view('websiteMainFiles.courses',['exams'=>$exams]);
    }
    public function examGetQuestions($examId){
        $exam = ExamPrep::find($examId);
        $examQuests = [];
        $numbers = json_decode($exam->selectedQuestIDs);
        foreach($numbers as $Number){
            $question = Question::find($Number);
            $examQuests[] = $question;
        }
        return view('staticExam.enteredExam',['examQuests'=>$examQuests,'examData'=>$exam]);
    }
    public function submitExam(Request $request)
    {
        Log::info($request);
        $answers = $request->input('answers'); // Ensure we are getting the answers
        $results = [];
        $errorCount = 0;
        $correctCount =0;
        foreach ($answers as $answer) {
            // Assuming you have a Question model and a 'id' field for question identification
            $question = Question::find($answer['questionNumber']); // Make sure questionNumber matches the ID

            if ($question) {
                $isCorrect = $question->CorrectAnswer === $answer['selectedAnswer'];
                $results[] = [
                    'correct' => $isCorrect,
                    'correctAnswer' => $question->CorrectAnswer
                ];

                if (!$isCorrect) {
                    $errorCount++;
                }
                else{
                    $correctCount++;
                }
            }
        }
        if(Auth::guard('Member')->check()){
            Log::info(Auth::guard('Member')->check());
            $performancetable = new examPerformance();
            $performancetable->ExamID= $request->input('examid');
            $performancetable->ExamTakenDate = Carbon::now()->format('Y-m-d');
            $performancetable->userID = Auth::guard('Member')->user()->id;
            $performancetable->correctAnswered = $correctCount;
            $performancetable->inCorrectAnswered = $errorCount;
            if($errorCount>=3){
                $performancetable->isPassed = false;
            }
            else{
                $performancetable->isPassed = true;
            }
            $performancetable->save();
        }
        // Handle too many errors
        if ($errorCount > 5) {
            return response()->json(['message' => 'Too many errors.'], 400); // Example error response
        }

        return response()->json(['results' => $results]); // Return the results as JSON
    }

// -----------------------------------------test? idk
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
}
