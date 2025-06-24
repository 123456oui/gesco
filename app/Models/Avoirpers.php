<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoirpers extends Model
{
    use HasFactory;
 protected $fillable =[
        'libellepers',
        'montant',     
    ];
    
}
