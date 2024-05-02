<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;

Route::get('/register',[AuthController::class,'loadRegister']);
Route::post('/register',[AuthController::class,'studentRegister'])->name('studentRegister');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');
Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget-password',[AuthController::class,'forgetPasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetPasswordLoad'])->name('forgetPassword');


    Route::group(['middleware'=>['web','checkAdmin']],function(){
        Route::post('file-import',[AdminController::class,'fileImport'])->name('file-import');
        Route::get('file-export', [AdminController::class,'fileExport'])->name('file-export');

        Route::get('candidate-export', [AdminController::class,'CandidateExport'])->name('CandidateExport');

        Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);
        Route::get('/addCandidate',[AdminController::class,'addCandidate']);

        Route::get('/subject',[AdminController::class,'subjects']);
        Route::post('/add-subject',[AdminController::class,'addSubject'])->name('addSubject');
        Route::post('/edit-subject',[AdminController::class,'editSubject'])->name('editSubject');
        Route::post('/delete-subject',[AdminController::class,'deleteSubject'])->name('deleteSubject');

        Route::get('/admin/exam',[AdminController::class,'examDashboard']); 
        Route::post('/add-exam',[AdminController::class,'addExam'])->name('addExam');
        Route::get('/get-exam-detail/{id}',[AdminController::class,'getExamDetail'])->name('getExamDetail');//this
        Route::post('/update-exam',[AdminController::class,'updateExam'])->name('updateExam');
        Route::post('/delete-exam',[AdminController::class,'deleteExam'])->name('deleteExam');
        Route::get('/admin/qna-ans',[AdminController::class,'qnaDashboard']); //q&a route
        Route::post('/add-qna-ans',[AdminController::class,'addQna'])->name('addQna');
        Route::get('/admin/students',[AdminController::class,'studentsDashboard']);
        Route::get('/get-questions',[AdminController::class,'getQuestions'])->name('getQuestions'); //q&a route
        Route::post('/add-questions',[AdminController::class,'addQuestions'])->name('addQuestions');
        Route::get('/get-exam-questions',[AdminController::class,'getExamQuestions'])->name('getExamQuestions');
        Route::post('/add-student',[AdminController::class,'addStudent'])->name('addStudent');
        Route::post('/delete-candidate',[AdminController::class,'DeleteCandidate'])->name('DeleteCandidate');
        Route::get('/admin/marks',[AdminController::class,'loadMarks']);
        Route::post('/update-marks',[AdminController::class,'updateMarks'])->name('updateMarks');
        Route::get('/admin/results',[AdminController::class,'results'])->name('results');
        Route::get('/admin/resultView',[AdminController::class,'resultView'])->name('resultView');
        Route::get('/admin/resultss',[AdminController::class,'resultss']);
        Route::get('/get-results-qna',[AdminController::class,'qnaResult'])->name('qnaResult');
        Route::post('/approve-qna',[AdminController::class,'approveQna'])->name('approveQna');
        Route::post('/import-qna',[AdminController::class,'importQna'])->name('importQna');
        Route::post('/delete-qna',[AdminController::class,'deleteQna'])->name('deleteQna');
        Route::get('/export-user-pdf',[AdminController::class,'export_user_pdf'])->name('export_user_pdf');
        Route::get('/export-exam-pdf',[AdminController::class,'export_exam_pdf'])->name('export_exam_pdf');
        Route::get('/print-page',[AdminController::class,'printpage'])->name('printpage');
        Route::get('/sortExam',[AdminController::class,'sortExam']);
        Route::get('/admin/candidateView',[AdminController::class,'candidateView'])->name('candidateView');
        Route::get('/homepage',[AdminController::class,'homepageView']);

    });

    Route::group(['middleware'=>['web','checkStudent']],function(){
        Route::get('/dashboard',[AuthController::class,'loadDashboard']);
        Route::get('/exam/{id}',[ExamController::class,'loadExamDashboard']);
        Route::post('/exam-submit',[ExamController::class,'examSubmit'])->name('examSubmit');
    
    });

