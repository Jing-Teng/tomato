<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class NotifyAlarm extends Model
{
    protected $fillable = [
        'name', 'alarm_time', 'open', 'cycle' , 'once'
    ];
    
    //和user的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
