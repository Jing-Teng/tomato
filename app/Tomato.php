<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;
use App\User;

class Tomato extends Model
{
    protected $fillable = [
        'name', 'end_date', 'length', 'result','color','icon','position', 'pcs', 'minute'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
