<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id' , 'department_id' , 'active' , 'reported'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id' , 'id');
    }


    public function department()
    {
        return $this->belongsTo('App\Models\Department' , 'department_id' , 'id');
    }
}
