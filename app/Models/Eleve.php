<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','numero_etudiant','email','image'];

    public function evaluation()
    {
        return $this->hasMany(EvaluationEleve::class);
    }
}