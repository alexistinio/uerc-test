<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'user_id',
        'f_id',
        'file_name',    
    ];
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }


    public function folder(){

        return $this->belongsTo(Folder::class, 'f_id');
    }
}
