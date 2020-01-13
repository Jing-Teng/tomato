<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;

class WakeupAlarm extends Model
{
    protected $fillable = [
        'name', 'alarm_time', 'open', 'cycle' , 'once'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
