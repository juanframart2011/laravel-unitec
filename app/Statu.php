<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    protected $table = "statu";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'statu_name', 'statu_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'statu_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'statu_creationDate' => 'datetime',
        'statu_lastModification' => 'datetime',
    ];

    
    public function careers(){

        return $this->hasMany( 'App\Career', 'statu_id', 'statu_id' );
    }

    public function genders(){

        return $this->hasMany( 'App\Gender', 'statu_id', 'statu_id' );
    }

    public function statuCivils(){

        return $this->hasMany( 'App\StatuCivil', 'statu_id', 'statu_id' );
    }

    public function studyGrades(){

        return $this->hasMany( 'App\StudyGrade', 'statu_id', 'statu_id' );
    }

    public function users(){

        return $this->hasMany( 'App\User', 'statu_id', 'statu_id' );
    }
}