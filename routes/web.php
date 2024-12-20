<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\adminLoginReg;
use App\Http\Controllers\AdminPageControl;
use App\Http\Controllers\examController;
use App\Http\Controllers\MemberLoginReg;
use App\Http\Controllers\MemberPages;
use App\Http\Controllers\QuestControl;
use App\Http\Controllers\roadSignController;
use App\Models\question;
use Illuminate\Support\Facades\Route;

Route::get('/', [MemberPages::class,'index'])->name('main');
//Route::get('users/{id}', [UserController::class, 'index'])->name('user.index');
Route::get('/main/tests', [MemberPages::class, 'SectionsPage'])->name('main.test');



//admin login and reg
Route::get('/adminLoginPage',[adminLoginReg::class,'AdminLoginPage'])->name('adminLoginPage');
Route::post('/adminLoginFunc',[adminLoginReg::class,'adminLoginFunc'])->name('adminLoginFunc');

Route::get('/addAdmin',[adminLoginReg::class,'addAdmin'])->name('addAdminDebug'); // ------------this is debug account need to be delete on release

//Route::get('/',[adminLoginReg::class,'AdminLoginPage'])->name('adminLoginPage');
//Route::get('/',[adminLoginReg::class,'AdminLoginPage'])->name('adminLoginPage');

// member login and reg
Route::get('/loginPage',[MemberLoginReg::class,'loginPage'])->name('login');
Route::post('/loginFunc',[MemberLoginReg::class,'loginFunc'])->name('loginFunc');
Route::get('/logout',[MemberLoginReg::class,'logout'])->name('logout');

Route::get('/registerPage',[MemberLoginReg::class,'registerPage'])->name('registerPage');
Route::post('/registerFunc',[MemberLoginReg::class,'registerFunc'])->name('registerFuncs');
// choosing sections test
Route::get('/Sections',[MemberPages::class,'SectionsPage'])->name('SectionPage');
Route::get('/OpenSection/{SectionNumber}',[MemberPages::class,'openSectionPage'])->name('OpenSection');

// choosing exam
Route::get('/exam/Sections',[MemberPages::class,'examSectionPage'])->name('exam.section');
Route::get('/exam/Sections/{examId}',[MemberPages::class,'examGetQuestions'])->name('exam.questions');
Route::post('/submit-exam',[MemberPages::class,'submitExam'])->name('submitExam');

// road signs
Route::get('/roadSign',[MemberPages::class,'roadSignsPage'])->name('roadSigns');

// contect us
Route::get('/contact',[MemberPages::class,'contactUs'])->name('contact');
// tests section  check correct answer

Route::post('/correctAnswered/{id}/{sectionID}',[MemberPages::class,'clickedCorrectAnswer'])->name('correctAnswered');
Route::post('/incorrectAnswered/{id}/{sectionID}',[MemberPages::class,'clickedInCorrectAnswer'])->name('incorrectAnswered');



Route::middleware(['auth:Admin'])->group(function(){
    Route::get('/adminDashboard',[AdminPageControl::class,'adminDAshboard'])->name('adminDashboard');

    Route::get('/admin/questionOverview',[AdminPageControl::class,'questionOverviewPage'])->name('questionOverview');

    //road signs(admin)
    Route::get('/roadSigns/overview',            [AdminPageControl::class,'overviewRoadSigns'])->name('roadsign.overview.page');
    Route::get('/roadSigns/add',        [AdminPageControl::class,'addRoadSignPage'])->name('roadsign.add.page');
    Route::post('/roadSigns/upload',    [roadSignController::class,'uploadSign'])->name('roadsign.upload');
    Route::get('/roadSigns/delete/{id}',[roadSignController::class,'deleteRoadSign'])->name('roadsign.delete');

    //add & remove Exams(admin)
    Route::get('/exam/overview',[examController::class,'examOverview'])->name('ExamOverview');

    Route::post('/exam/create',[examController::class,'createExam'])->name('createExam.func');
    Route::get('/exam/getSections/{examId}',[examController::class,'getSections'])->name('getSections');
    Route::get('/exam/getQuestsFromSection/{sectionId}/{examId}',[examController::class,'getQuestsFromSection'])->name('getQuestsFromSection.page');//section id
    Route::get('/exam/addingExamQuest/{QuestId}/{examid}',action: [examController::class,'AddQuestToTempTable'])->name('AddQuestToTempTable.func');//question id and form
    Route::get('/exam/RemoveFromTemp/{id}/{examid}',[examController::class,'removeQuestFromTempTable'])->name('RemoveQuestToTempTable.func');//question id and form

    // Edits (admin)
    Route::get('/AddQuestion',[AdminPageControl::class,'QuestionAddPage'])->name('AddQuestionPage');
    Route::post('/AddingQuestion',[QuestControl::class,'store'])->name('StoreQuestionFunc');

    Route::get('/AddSection',[AdminPageControl::class,'SectionAddPage'])->name('AddSectionPage');
    Route::post('/AddingSection',[QuestControl::class,'AddSection'])->name('AddSectionFunc');

    Route::get('/edit/section/{id}',[QuestControl::class,'OpenSectionForEdit'])->name('OpenSectionForEdit');
    Route::get('/editQuestion/{id}',[QuestControl::class,'EditQuestionPage'])->name('editQuestion');
    Route::post('/submitEditedQuestion/{id}',[QuestControl::class,'submitEditedTest'])->name('submitEditQuestion');

});

Route::middleware(['auth:Member'])->group(function () {

    Route::get('/DashboardM',[MemberPages::class,'Dashboard'])->name('MemberDashboard');

});
