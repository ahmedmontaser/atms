<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic',
        'user_id',
        'department_id',
    ];

    public  function user(){
        return $this->belongsTo('App\Models\User' , 'user_id'  , 'id');
    }

    public function notifications(){
        return $this->hasMany('App\Models\Notifications' , 'user_id' , 'user_id');
    }


    public function requests(){
        return $this->hasMany('App\Models\Requests' , 'user_id' , 'user_id');
    }



    public function department(){
        return $this->belongsTo('App\Models\Department' , 'department_id' , 'id');
    }


}
