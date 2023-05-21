<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_name',
        'subject_id',
        'date',
        'time'
    ];

    public function subjects() //many to one relationship happen here
    {
        return $this->hasMany(Subject::class,'id','subject_id'); // Creating relationship
    }

    public function getQnaExam() //many to one relationship happen here
    {
        return $this->hasMany(QnaExam::class,'exam_id','id'); // Creating relationship
    }

    // public function examCode()
    // {
    //     $user_exam_code = Auth::user()->exam_code;
    //     $exams = Exam::where('subject_id','=',$user_exam_code)->get();
    //     return $exams;
    // }
}
