<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens; //passport
use App\Exam;
use App\Task;
use App\NotifyAlarm;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
	use Notifiable, HasApiTokens; //passport

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //和exams tasks notify_alarms的關聯
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function notifyAlarms()
    {
        return $this->hasMany(NotifyAlarm::class);
    }
}
