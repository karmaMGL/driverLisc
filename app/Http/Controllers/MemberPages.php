<?php

namespace App\Http\Controllers;

use App\Charts\TestChart;
use App\Models\examPerformance;
use App\Models\ExamPrep;
use App\Models\question;
use App\Models\roadSign;
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
        session(['member'=> 'home']);
        return view("websiteMainFiles.index",['MatchSection'=>$SectionNumber,'QuestionCounts'=>$Counts,'Title'=>$names]);
    }
    public function SectionsPage(){
        $Counts = [];
        $SectionNumber = [];
        $names = [];
        $questions = question::all();
        session(['member'=> 'tests']);

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
        session(['member'=> 'exams']);
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
    // ---------------------------------------->road sign page and test
    public function roadSignsPage(){
        session(['member'=> 'roadSigns']);
        $roadSigns =  roadSign::all();
        return view('websiteMainFiles.courses',['roadSigns'=>$roadSigns]);
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
        $correct =0;
        $incorrect = 0;
        Log::alert(performance::select('testTakenDate')->distinct()->get());
        foreach($performaneOfmember as $per){
            $correctCount = performance::where('testTakenDate' ,$per->testTakenDate )->where('isCorrect',true)->get()->count();
            $incorrectCount = performance::where('testTakenDate' ,$per->testTakenDate )->where('isCorrect',false)->get()->count();

            $data[] = ['label'=>$per->testTakenDate, 'correct'=>$correctCount,'incorrect'=>$incorrectCount,'correct_url'=>"/member/tests/performance/1/".$per->testTakenDate,'incorrect_url'=>"/member/tests/performance/0/".$per->testTakenDate];
            $correct= $correct+$per->correctAnswered;
            $incorrect=  $incorrect+ $per->inCorrectAnswered;
        }

        $totalNumbers = ['incorrect'=>$incorrect , 'correct'=>$correct,'testsTaken'=>count(examPerformance::where('userID',Auth::guard('Member')->user()->id)->get())];

        return view('MembersPages.Dashboard', ["userData" => $datas,'data'=>$data,'userDataNumber'=>$totalNumbers ]);
    }
    public function examineDate($isCorrect,$date){ // i was working here
        Log::alert($isCorrect." ".$date);
        $data = performance::where('userID',Auth::guard('Member')->user()->id)->where('isCorrect',$isCorrect)->where('testTakenDate',$date)->get();
        $datas = [];
        $questIDs = performance::where('userID',Auth::guard('Member')->user()->id)->select('questID')->distinct()->get();
        foreach($questIDs as $one){
            Log::alert($one);
            $data[] = [
                'label'=>Section::find(question::find($one['questID'])->SectionIDSelected).'/'.question::find($one['questID']),
                'correct'=>performance::where('userID',Auth::guard('Member')->user()->id)->where('isCorrect',$isCorrect)->get()->count(),
                'incorrect'=>0,
            ];
        }
        Log::alert(performance::where('userID',Auth::guard('Member')->user()->id)->select('questID')->distinct()->get());
        return view('MembersPages.layout',["data"=>$data]);
    }
    public function clickedCorrectAnswer(Request $request , $id,$sectionID,$answer,$questID) {
        $member = Auth::guard('Member')->user();
        $today = Carbon::now()->format('Y-m-d');
        $Checkk = performance::where('userID',$member->id)->where('testTakenDate',$today)->first();
        Log::info($answer);


        $newData = new performance;
        $newData->userID = $member->id;
        $newData->testTakenDate =  $today;
        $newData->questID = $questID;
        $newData->Answered = $answer;
        $newData->sectionID = $sectionID;
        $newData->isCorrect = true;
        $newData->save();


        return response()->json([
            'message' => 'Correct answer recorded',
            'status' => 'success'
        ]);
    }

    public function clickedInCorrectAnswer(Request $request,$id,$sectionID,$answer,$questID) {

        $member = Auth::guard('Member')->user();
        $today = Carbon::now()->format('Y-m-d');
        $Checkk = performance::where('userID',$member->id)->where('testTakenDate',$today)->first();
        Log::info($answer);

        $newData = new performance;
        $newData->userID = $member->id;
        $newData->testTakenDate =  $today;
        $newData->questID = $questID;
        $newData->Answered = $answer;
        $newData->sectionID = $sectionID;
        $newData->isCorrect = false;
        $newData->save();


        return response()->json([
            'message' => 'Incorrect answer recorded',
            'status' => 'error'
        ]);
    }
    public function contactUs(){
        session(['member'=>'contact']);
        return view('websiteMainFiles.contact');
    }
}
