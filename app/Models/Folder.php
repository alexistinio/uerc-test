<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'user_id',
        'folder_name',
     
    ];
    use HasFactory;

    public function meetings(){

        return $this->hasMany(Meeting::class, 'f_id');
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
