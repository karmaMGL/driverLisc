<?php

namespace App\Http\Controllers;

use App\Models\question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        Log::info($request);

        // $val = $request->validate([
        //     'sectionNumberSelected' =>'numeric|required',
        //     'title' =>'string|required',
        //     'context' =>'required|string',
        //     'why'=>'required|string',

        // ]);
        $store = new question();
        $store->Title = $request['title'];
        $store->Options = json_encode($request["options"]);
        $store->Why = $request['why'];
        if(isset($request->imagePath)){
            $file = $request->file('imagePath');
            $file->move(public_path('public'),$file->getClientOriginalName());
            $store->imagePath = asset('public').'/'.$file->getClientOriginalName();
        }

        $store->CorrectAnswer = $request['correctAnswer'];
        $store->SectionIDSelected  = $request->sectionNumberSelectedId;
        $store->save();
        return redirect('/');
    }
    public function AddSection(Request $request){
        //$sec = new Section;
        $val = $request->validate([
            'title'=>'string|required|unique:sections',
            'SectionNumber'=>'required|numeric'
        ]);
        Section::create(['title'=>$request->title,'SectionNumber'=>$request->SectionNumber]);
        return redirect('/');
    }
    /**
     * Display the specified resource.
     */
    public function show(question $question)
    {
        //
    }
    public function submitEditedTest(Request $request, $id){
        $data = question::find($id);
        $data->title = $request->title;
        $data->Options = json_encode($request->options,true);
        $data->CorrectAnswer = $request->correctAnswer;
        if(isset($request->imagePath)){
            $file = $request->file('imagePath');
            $file->move(public_path('public'));
            $fileName = time().$file->getClientOriginalName();
            $data->ImagePath=asset('public/'.$fileName);
        }
        $data->save();
                                                                                            // im working here
        return redirect('/admin/questionOverview');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function OpenSectionForEdit($id){
        $sec = Section::find($id);
        $ds = question::where('SectionIDSelected','like',$id)->get();
        $site = view('editPages.questionOverview',['questions'=>$ds]);// this sends data like sections but with questions
        return view('adminLayout.adminLayout',['content'=>$site]);
    }
    public function editOneQuestion(Request $question)
    {

        return view('editPages.editQuestion');
    }
    public function EditQuestionPage($id)
    {

        $data = question::where('id','like',$id)->first();
        $section = Section::all();
        $selectedSection =Section::find($data->SectionIDSelected);
        $options = json_decode($data->Options,true);
        $overlay = view('editPages.editQuestion',['data'=> $data,'options'=>$options, 'section'=> $section,'selectedSection'=>$selectedSection]);
        return view('adminLayout.adminLayout',['content'=>$overlay]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        //
    }
}
