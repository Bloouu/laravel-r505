<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Module;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // Afficher la liste des évaluations
    public function index()
    {
        $evaluations = Evaluation::with('module')->get(); // Récupérer toutes les évaluations avec leurs modules associés
        return view('evaluations.index', compact('evaluations'));
    }

    // Afficher le formulaire de création d'une évaluation
    public function create()
    {
        $modules = Module::all(); // Récupérer tous les modules pour afficher dans le formulaire
        return view('evaluations.create', compact('modules'));
    }

    // Enregistrer une nouvelle évaluation
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'coefficient' => 'required|numeric',
            'module_id' => 'required|exists:modules,id',
        ]);

        Evaluation::create($validatedData);

        return redirect()->route('evaluations.index')->with('success', 'Évaluation ajoutée avec succès.');
    }

    // Afficher le formulaire de modification d'une évaluation
    public function edit($id)
    {

        $evaluation = Evaluation::findOrFail($id);
        $modules = Module::all(); // Récupérer les modules pour les afficher dans le formulaire de modification
        return view('evaluations.edit', compact('evaluation', 'modules'));
    }

    // Mettre à jour une évaluation
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'coefficient' => 'required|numeric',
            'module_id' => 'required|exists:modules,id',
        ]);

        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update($validatedData);

        return redirect()->route('evaluations.index')->with('success', 'Évaluation mise à jour avec succès.');
    }

    // Supprimer une évaluation
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès.');
    }
}
