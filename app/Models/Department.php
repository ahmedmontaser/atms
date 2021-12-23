<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    public function employees(){
        return $this->hasMany('App\Models\Employee' , 'department_id' , 'id');
    }

    public function question(){
        return $this->hasMany('App\Models\Question' , 'department_id' , 'id');
    }

}
