<?php namespace TT\Models;

use TT\Traits\UserParentTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StudentParent extends User
{
    use UserParentTrait;

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
        $this->modelTraitType = 'TT\Models\ParentTrait';
    }

    public function groups()
    {   
        return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot, 'user_id', 'group_id');
    }

    public function student()
    {
        return $this->belongsToMany('TT\Models\Student','parents_students','parent_id','student_id');
    }

    public function students()
    {
        return $this->belongsToMany('TT\Models\Student','parents_students','parent_id','student_id');
    }

    public function fill(array $fillable)
    {
        $fillable = array_add($fillable,'traits_type',$this->modelTraitType);

        parent::fill($fillable);
    }

    public function getRelationshipAttribute()
    {
        return $this->pivot->relationship;
    }

}
