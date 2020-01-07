<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\exam;

class Task extends Model
{
    
    protected $fillable = ['name','description'];

    //和exam的關聯
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

}
