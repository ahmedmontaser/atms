<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'text',
    ];



    public function answers(){
        return $this->hasMany('App\Models\Answer' , 'question_id' , 'id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Department' , 'department_id' , 'id');
    }
}
