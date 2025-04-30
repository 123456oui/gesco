<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcharge extends Model
{
    use HasFactory;
    protected $fillable =[
        'libellepcharge',
        'pmontant',
    ];
}
