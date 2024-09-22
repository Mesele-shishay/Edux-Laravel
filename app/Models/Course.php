<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $casts =[
        'start'=>'date',
        'end'=>'date',
    ];

    protected $fillable = ['course_name','course_type','class_id','semester_id','session_id'];

    public function teacher()
    {
        return $this->belongsTo(AssignedTeacher::class,'id','course_id')->with('teacher','user');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class,'course_id','id')->with('rule','exam');
    }
}
