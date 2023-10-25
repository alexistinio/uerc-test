<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $fillable = [
        'title',
        'firstname',
        'initial',
        'lastname',
        'email',
        'phone_number',
        'position',     
    ];
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }
}
