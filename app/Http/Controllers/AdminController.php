<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Answer;
use App\Models\QnaExam;
use App\Models\Subject;
use App\Models\Question;
use App\Imports\QnaImport;
use App\Models\ExamAnswer;
use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use App\Imports\CandidateSort;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CandidateExportSort;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{

    public function homepageView(){
        return view('admin.landing');
    }
    //adding the subject
    public function addSubject(Request $request)
    {
        try{

            Subject::insert([
                'subject'=> $request->subject 
            ]);

            return response()->json(['success'=>true,'msg'=>'Subject added Successfully!!']);

        }catch(\Exception $e){      
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }



    //edditing the subject
    public function editSubject(Request $request)
    {
        try{

           $subject = Subject::find($request->id);
           //updating the subject
           $subject  -> subject = $request->subject;
           //to save the subject
           $subject  -> save();


            return response()->json(['success'=>true,'msg'=>'Subject Updated Successfully!!']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }



    //delete the subject
    public function deleteSubject(Request $request)
    {
        try{

            subject::where('id',$request->id)->delete();
            return response()->json(['success'=>true,'msg'=>'Subject Deleteed Successfully!!']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    //exam dashboard loading part
    public function examDashboard()
    {
        
        $subjects = Subject::all(); 
        $exams = Exam::with('subjects')->get();
        return view('admin.exam-dashboard',['subjects'=>$subjects,'exams'=>$exams]); 
    }

    public function subjects()
    {
        $subjects = subject::all();
        return view('admin.subjects',compact('subjects'));
    }

    //adding exam to the database
    public function addExam(Request $request)
    {
        try{

            $unique_id = uniqid ('exid');
            Exam::insert([
                'exam_name' => $request->exam_name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time,
                'entrance_id' => $unique_id
            ]);
            return response()->json(['success'=>true,'msg'=>'Exam added Successfully!!']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    //edit exam ajax function that will hit the data
    public function getExamDetail($id)
    {
        try{

            $exam = Exam::where('id',$id)->get();     
            return response()->json(['success'=>true,'data'=>$exam]);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }


    public function updateExam(Request $request)
    {
        try{

            $exam = Exam::find($request->exam_id);    
            $exam->exam_name = $request->exam_name;
            $exam->subject_id = $request->subject_id;
            $exam->date = $request->date;
            $exam->time = $request->time;
            $exam->save();
            return response()->json(['success'=>true,'msg'=>'Exam Update Successfully!!..']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    //delete Exam
    public function deleteExam(Request $request)
    {
        try{

            Exam::where('id',$request->exam_id)->delete();     
           
            return response()->json(['success'=>true,'msg'=>'Exam Deleted Successfully!!..']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    //Q&A
    public function qnaDashboard()
    {
        $questions = Question::with(['answers','exams'])->get();
        return view('admin.qnaDashboard', compact('questions')); 
    }

    //add QnA function
    public function addQna(Request $request)
    {
        try{

            //storing data to the database
            $questionId = Question::insertGetId([
                'question' => $request->question,
                'subject_id' => $request->subject_id

            ]);

            foreach($request->answers as $answer){

                //to check the correct answer
                $is_correct = 0;
                if($request->is_correct == $answer){
                    $is_correct = 1;
                }

                Answer::insert([
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct
                ]);

            }
         
            return response()->json(['success'=>true,'msg'=>'Exam Deleted Successfully!!..']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    //students dashboard
    public function studentsDashboard(){

        $students = User::where('is_admin', 0)->get();
        return view('admin.studentsDashboard',compact('students'));
    }


    //get questions function
    public function getQuestions(Request $request)
    {
        try{

                $questions = Question::all();

                if(count($questions) > 0){

                    $data =[];  
                    $counter = 0;

                    foreach($questions as $question){ 
                        $qnaExam = QnaExam::where(['exam_id'=>$request->exam_id,'question_id'=>$question->id])->get(); //take the data with the id
                        if(count($qnaExam) == 0){
                            $data[$counter]['id'] = $question->id;
                            $data[$counter]['questions'] = $question->question;
                            $counter++;

                        }
                    }
                    return response()->json(['success'=>true,'msg'=>'Question data!','data'=>$data]);

                }
                else{
                    return response()->json(['success'=>false,'msg'=>'Question not found!!']);
                }

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
        
    }

    //addQuestion function
    public function addQuestions(Request $request)
    {
        try{
            if(isset($request->question_ids)){
                foreach($request->question_ids as $qid){
                    QnaExam::insert([
                        'exam_id' => $request->exam_id,
                        'question_id' => $qid

                    ]);
                }
            }
            return response()->json(['success'=>true,'msg'=>'Question added Succesfully']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    //import candidate and export candidate
    public function addCandidate()
    {
        return view('admin.addCandidate');
    }
    
    public function fileImport(Request $request){
        Excel::import(new UserImport, $request->file('file')->store('temp'));
        return redirect('/addCandidate')->with('success','Candidate added successfully');
    }

    public function fileExport(){
        return Excel::download(new UserExport, 'candidate-lists.xlsx');
    }

    public function getExamQuestions(Request $request){

        try{
            
            //$data = $request->query('exam_id');
            $data = QnaExam::where('exam_id',$request->exam_id)->with('question')->get();
            //$data = $request->exam_id;
            return response()->json(['success'=>true,'msg'=>'Questions details!','data'=>$data]);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    //add student from admin dashboard
    public function addStudent(Request $request){

        try{
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'exam_code' => $request->exam_code,
                'password' => Hash::make($request->password) 
            ]);
            return response()->json(['success'=>true,'msg'=>'Student added Successfully']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

        }

    }


    //delete Candidate
    public function DeleteCandidate(Request $request)
    {
        try{

            User::where('id',$request->id)->delete();     
           
            return response()->json(['success'=>true,'msg'=>'Candidate Deleted Successfully!!..']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }


    //marks
    public function loadMarks(){

        $exams = Exam::with('getQnaExam')->get();
        return view('admin.marksDashboard',compact('exams'));
    }

    public function updateMarks(Request $request){
        try{

            Exam::where('id',$request->exam_id)->update([
                'marks' => $request->marks
            ]); 
            return response()->json(['success'=>true,'msg'=>'Marks Updated']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    public function results()
    {
        $attempts = ExamAttempt::with(['user','exam'])->orderBy('id')->get();
        return view('admin.result',compact('attempts'));
    }
    public function resultView(Request $request)
    {
        $exam_id = $request->exam_id;
        $exam_name = Exam::where('id',$exam_id)->pluck('exam_name')->first();
        $attempts = ExamAttempt::where('exam_id',$exam_id)->get();
        return view('admin.result',compact('attempts','exam_id','exam_name'));
    }
    public function resultss()
    {
        $attempts = Exam::all();
        return view('admin.results',compact('attempts'));
    }

    public function qnaResult(Request $request)
    {
    try{
        $attemptData = ExamAnswer::where('attempt_id',$request->attempt_id)->with(['question','answers'])->get();
        return response()->json(['success'=>true,'data'=>$attemptData]);

    }catch(\Exception $e){
        return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
    };
    }

    public function approveQna(Request $request){
        try{
            
            $attemptId = $request->attempt_id;

            $examData = ExamAttempt::where('id',$attemptId)->with('exam')->get();
            $marks = $examData[0]['exam']['marks'];

            $attemptData = ExamAnswer::where('attempt_id',$attemptId)->with('answers')->get();

            $totalMarks = 0;

            if(count($attemptData) > 0){

                foreach ($attemptData as $attempt) {
                    
                    if($attempt->answers->is_correct == 1){
                        $totalMarks += $marks;
                    }

                }
            }
            ExamAttempt::where('id',$attemptId)->update([
                'status' => 1,
                'marks' => $totalMarks
            ]);

            return response()->json(['success'=>true,'msg'=>'Approved Successfully']);
    
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    public function deleteQna(Request $request){

        Question::where('id',$request->id)->delete();
        Answer::where('question_id',$request->id)->delete();

        return response()->json(['success'=>true,'msg'=>'Q&A deleted successfully']);
    }

    public function importQna(Request $request){
        try{

            Excel::import(new QnaImport, $request->file('file'));

            return response()->json(['success'=>true,'msg'=>'Imported successful']);

        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        };
    }

    public function export_user_pdf(Request $request){

        $attempt_id = $request->attempt_id;
        $name = $request->name;
        $id = $request->id;
        $attempts = ExamAnswer::where('attempt_id',$attempt_id)->with(['question','answers'])->get();
        $pdf = PDF::loadView('pdf.result',[
            'attempts' => $attempts,
            'name' => $name,
            'id' => $id

        ]);
        return $pdf->download('answerScript.pdf');
    }

    public function printpage(){
        $pdf = PDF::loadView('pdf.invoice', $data);
    return $pdf->download('invoice.pdf');
    }

    public function export_exam_pdf(Request $request){

        $exam_id = $request->attempt_id;
        $attempts = ExamAttempt::where('exam_id',$exam_id)->with(['user','exam'])->get();
        $pdf = pdf::loadView('pdf.candidateMarks',[ 
            'attempts' => $attempts,
            'exam_id' => $exam_id
        ]);
        return $pdf->download('Marks.pdf');
    }

    public function sortExam()
    {
        $attempts = Exam::all();
        return view('admin.sortExam',compact('attempts'));
    }

    public function candidateView(Request $request)
    {
        $exam_id = $request->exam_id;
        $exam_name = Exam::where('id', $exam_id)->pluck('exam_name')->first();
        $students = User::where('exam_code',$exam_id)->get();
        return view('admin.candidateSortlist',compact('students','exam_name','exam_id'));
    }
    
    public function CandidateExport(Request $request){
        $exam_id = $request->exam_id;
        return Excel::download(new CandidateExportSort($exam_id), 'candidate-lists.xlsx');
    }
    
}

?>