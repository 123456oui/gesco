<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cantineanne extends Model
{
    use HasFactory;
     protected $fillable =[
        'annee',
        'montant_mois',     
    ];
}
