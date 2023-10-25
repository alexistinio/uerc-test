<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'colleges',   
        'courses',  
    ];
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }


    
}
