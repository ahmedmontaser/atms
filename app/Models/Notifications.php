<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'accept', 'seen', 'seen_by_user', 'request_id' , 'user_id' , 'department_id'
    ];

    public function request()
    {
        return $this->belongsToMany('App\Models\Requests' , 'request_id' , 'id');
    }

    public function employee(){
        return $this->belongsToMany('App\Models\Employee' , 'user_id' , 'user_id');
    }
}
