<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolCode extends Model
{
    protected $fillable = [
        'year',
        'category_codes',
        'program_codes',
        'sequence_codes',
        'protocol_code'
    ];
    use HasFactory;
}
