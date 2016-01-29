<?php namespace TT\Models;

class StudentTrait extends \Eloquent
{
    protected $table = 'students_traits';

    public $timestamps = false;

    protected $fillable = ['student_code','activity_total_time','ace_code','student_id'];
}
