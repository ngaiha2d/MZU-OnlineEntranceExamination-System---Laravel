<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    //
    public function loadExamDashboard($id)
    {
        $qnaExam = Exam::where('entrance_id',$id)->with('getQnaExam')->get();
        if(count($qnaExam) > 0){

            if($qnaExam[0]['date'] == date('Y-m-d')){
                
                if(count($qnaExam[0]['getQnaExam']) > 0){

                    $qna = QnaExam::where('exam_id',$qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->get();
                    return view('student.exam-dashboard',['success'=>true,'exam'=>$qnaExam,'qna'=>$qna]);
                    
                }else{
                    return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam is not available for now ','exam'=>$qnaExam]);
                }

            }else if($qnaExam[0]['date'] > date('Y-m-d')){
                return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam will start soon1 ','exam'=>$qnaExam]);

            }else{
                return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam has Expired ','exam'=>$qnaExam]);
            }

        }else{
            return view('404');
        }
    }

    public function examSubmit(Request $request){


        $attempt_id = ExamAttempt::insertGetId([
            'exam_id' => $request->exam_id,
            'user_id' => Auth::user()->id
        ]);
 
        $qcount = count($request->q);
        if($qcount > 0){

            for($i = 0; $i < $qcount; $i++){
                ExamAnswer::insert([
                    'attempt_id' => $attempt_id,
                    'question_id' => $request->q[$i],
                    'answer_id' => request()->input('ans_'.($i+1))
                ]);
            }
        }

            $examData = ExamAttempt::where('id',$attempt_id)->with('exam')->get();
            $marks = $examData[0]['exam']['marks'];

            $attemptData = ExamAnswer::where('attempt_id',$attempt_id)->with('answers')->get();

            $totalMarks = 0;

            if(count($attemptData) > 0){

                foreach ($attemptData as $attempt) {
                    
                    if($attempt->answers->is_correct == 1){
                        $totalMarks += $marks;
                    }

                }
            }
            ExamAttempt::where('id',$attempt_id)->update([
                'status' => 1,
                'marks' => $totalMarks
            ]);

        $user_id = Auth::user()->id;

        User::where('id', $user_id)->update(['attempt' => '1']);

        return view('thank-you');

    }

    public function logout(Request $request)
    {
        $request -> session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
