<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = "gender";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender_name', 'gender_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'gender_id', 'statu_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gender_creationDate' => 'datetime',
        'gender_lastModification' => 'datetime',
    ];

    public function statu(){

        return $this->belongsTo( 'App\Gender', 'statu_id', 'statu_id' );
    }

    public function users(){

        return $this->hasMany( 'App\User', 'gender_id', 'gender_id' );
    }
}
