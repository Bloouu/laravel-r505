<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['titre','date','coefficient','module_id'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function evaluation_eleve()
    {
        return $this->hasMany(EvaluationEleve::class);
    }
}
