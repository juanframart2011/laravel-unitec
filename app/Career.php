<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
	protected $table = "career";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'career_name', 'career_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'career_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'career_creationDate' => 'datetime',
        'career_lastModification' => 'datetime',
    ];

    public function statu(){

        return $this->belongsTo( 'App\Gender', 'statu_id', 'statu_id' );
    }

    public function studyGrade(){

        return $this->belongsTo( 'App\studyGrade', 'studyGrade_id', 'studyGrade_id' );
    }

    public function users(){

        return $this->hasMany( 'App\User', 'user_id', 'user_id' );
    }
}