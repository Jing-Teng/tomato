<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tomato;
use App\wakeupAlarm;

class Exam extends Model
{
    protected $fillable = ['name', 'end_date'];

    //和user的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //和鬧鐘、番茄的關係
    public function wakeupAlarms()
    {
        return $this->belongsTo(WakeupAlarm::class);
    }

    public function tomatoes()
    {
        return $this->belongsTo(Tomato::class);
    }

}
