<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $fillable = ['id_eleve', 'id_banque', 'montant', 'cumule' , 'annee' ,'ticketbanque'];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve', 'Matricule');
    }

    public function banque()
    {
        return $this->belongsTo(Banque::class, 'id_banque');
    }
}
