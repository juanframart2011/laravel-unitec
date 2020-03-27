<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'user_email', 'user_lastName', 'user_lastNameSec', 'user_age', 'user_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password', 'user_id', 'statu_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_creationDate' => 'datetime',
        'user_lastModification' => 'datetime',
    ];

    public function career(){

        return $this->belongsTo( 'App\Statu', 'career_id', 'career_id' );
    }

    public function gender(){

        return $this->belongsTo( 'App\Gender', 'gender_id', 'gender_id' );
    }

    public function statu(){

        return $this->belongsTo( 'App\Gender', 'statu_id', 'statu_id' );
    }

    public function statuCivil(){

        return $this->belongsTo( 'App\statuCivil', 'statuCivil_id', 'statuCivil_id' );
    }
}