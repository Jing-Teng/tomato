<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Setting extends Model
{
    protected $fillable = ['path','length','short','long','battle','ring','vibration', 'minute', 'pcs'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
