<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;

class Exam extends Model
{
    protected $fillable = ['name','description','start_date','end_date'];

    //跟user和tasks的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
