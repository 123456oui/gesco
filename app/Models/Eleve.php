<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    protected $table = 'eleves'; // important si le modèle ne suit pas la convention Laravel
    protected $primaryKey = 'Matricule';
    public $incrementing = false; // car ce n’est pas un entier auto-incrémenté
    protected $keyType = 'string';

    protected $fillable = [
        'Matricule', 'Nom', 'Prenom', 'Nomp', 'Nomm','numbactnaiss',
        'Photo', 'NumtelM', 'NumtelP', 'datenais', 'lieunais', 'Sante', 
        'created_at','acte_naissance', 'billetin',
    ];
}