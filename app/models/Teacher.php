<?php namespace TT\Models;

use TT\Traits\UserTeacherTrait;

class Teacher extends User
{
    use UserTeacherTrait;

    protected $fillable = [ 'first_name',
                            'last_name',
                            'email',
                            'title',
                            'password',
                            'traits_id',
                            'traits_type',
                            'activated'
                          ];
    
    protected $table = 'users';
    
    public function __construct() {
        $this->modelTraitType = 'TT\Models\Teachertrait';
    }

    public function fill(array $fillable)
    {
        $fillable = array_add($fillable,'traits_type',$this->modelTraitType);

        parent::fill($fillable);
    }

    public function groups()
    {   
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot, 'user_id', 'group_id');
    }

    public function students()
    {
        return $this->belongsToMany('TT\Models\Student','teachers_students','teacher_id','student_id');
    }

    public function schools()
    {
        return $this->belongsToMany('TT\Models\School','teachers_schools');
    }

}
