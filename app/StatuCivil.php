<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatuCivil extends Model
{
    protected $table = "statu_civil";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'statuCivil_name', 'statuCivil_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'statuCivil_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'statuCivil_creationDate' => 'datetime',
        'statuCivil_lastModification' => 'datetime',
    ];

    public function statu(){

        return $this->belongsTo( 'App\statuCivil', 'statu_id', 'statu_id' );
    }

    public function users(){

        return $this->hasMany( 'App\User', 'statuCivil_id', 'statuCivil_id' );
    }
}
