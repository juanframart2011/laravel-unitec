<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyGrade extends Model
{
	protected $table = "study_grade";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'studyGrade_name', 'studyGrade_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'studyGrade_id', 'statu_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'studyGrade_creationDate' => 'datetime',
        'studyGrade_lastModification' => 'datetime',
    ];

    public function careers(){

        return $this->hasMany( 'App\Career', 'studyGrade_id', 'studyGrade_id' );
    }

    public function statu(){

        return $this->belongsTo( 'App\studyGrade', 'statu_id', 'statu_id' );
    }

    public function users(){

        return $this->hasMany( 'App\User', 'studyGrade_id', 'studyGrade_id' );
    }
}
