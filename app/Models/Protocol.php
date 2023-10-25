<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $guarded = [];

    
    use HasFactory;
    

    public function user(){

        return $this->belongsTo(User::class);
    }


    public function edits(){

        return $this->hasMany(Timestamp::class);
    }

    public function return_note(){

        return $this->hasMany(ReturnNote::class);
    }

    public function t_note(){

        return $this->hasMany(TerminateNote::class);
    }

}
