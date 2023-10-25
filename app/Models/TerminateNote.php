<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminateNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocol_id',
        'note',
        'from',
    ];

    public function protocol(){

        return $this->belongsTo(Protocol::class);
    }
}
