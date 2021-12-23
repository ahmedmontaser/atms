<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'status',
    ];

    public  function notifications(){
        return $this->hasMany('App\Models\Notifications' , 'request_id'  , 'id');
    }

    public  function user(){
        return $this->belongsTo('App\Models\User' , 'user_id'  , 'id');
    }

    public  function employee(){
        return $this->belongsTo('App\Models\Employee' , 'user_id'  , 'id');
    }

}
