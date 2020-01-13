<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;

class Tomato extends Model
{
    protected $fillable = [
        'name', 'end_date', 'length', 'result'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
