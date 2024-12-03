<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\EvaluationEleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    // Afficher la liste des évaluations
    public function index()
    {
        $eleves = Eleve::all();
        return view('eleves.index', compact('eleves'));
    }

    // Afficher le formulaire de création d'une évaluation
    public function create()
    {
        return view('eleves.create');
    }

    // Enregistrer une nouvelle évaluation
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero_etudiant' => 'required|string|min:8|max:8',
            'email' => 'required|string|max:255',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Eleve::create($request->all());
        return redirect()->route('eleves.index')->with('success', 'Éleve ajouté avec succès.');
    }

    // Afficher le formulaire de modification d'une évaluation
    public function edit($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('eleves.edit', compact('eleve'));
    }

    // Mettre à jour une évaluation
    public function update(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero_etudiant' => 'required|string|min:8|max:8',
            'email' => 'required|string|max:255',
            'image' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect() ->back() ->withErrors($validator) ->withInput();
        }

        $eleve->update($request->all());

        return redirect()->route('eleves.index')->with('success', 'Éleve mis à jour avec succès.');
    }

    // Supprimer une évaluation
    public function destroy($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        return redirect()->route('eleves.index')->with('success', 'Éleve supprimé avec succès.');
    }

    public function showNotes($id)
    {
        $notes = EvaluationEleve::with('eleve')
            ->where('eleve_id', $id)
            ->get();

        return view('eleves.notes', compact('notes', 'id'));
    }
}
