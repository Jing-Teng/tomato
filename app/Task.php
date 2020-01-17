<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    
    protected $fillable = ['name','result'];

    //和user的關聯
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
