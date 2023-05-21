<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'subject_id'
    ];

    //one to many relation 
    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','id');  //question_id is repeated foreign key
    }

    public function exams(){
        return $this ->hasMany(Subject::class,'id','subject_id');
    }
}
