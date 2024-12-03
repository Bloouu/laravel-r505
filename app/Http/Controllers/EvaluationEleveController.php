<?php

namespace App\Http\Controllers;

use App\Models\EvaluationEleve;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluationEleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluations_eleves = EvaluationEleve::with(['eleve','evaluation'])->get();
        return view('evaluations_eleves.index', compact('evaluations_eleves'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('evaluations_eleves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation_id' => 'required|exists:evaluations,id',
            'eleve_id' => 'required|exists:eleves,id',
            'note' => [
                'required',
                'numeric',
                'between:0,20',
                'regex:/^\d{1,2}(\.\d{1,2})?$/',
            ],
        ], [
            'note.regex' => 'La note doit être un nombre décimal valide avec jusqu\'à deux chiffres après la virgule.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EvaluationEleve::create($request->all());
        return redirect()->route('evaluations_eleves.index')->with('success', 'Évaluation d\'éleve ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluations = Evaluation::all();
        $eleves = Eleve::all(); 
        return view('evaluations_eleves.edit', compact('evaluation_eleve', 'evaluations', 'eleves'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluations = Evaluation::all();
        $eleve = Eleve::all();

        return view('evaluations_eleves.edit', compact('evaluation_eleves', 'evaluations', 'eleves'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'evaluation_id' => 'required|exists:evaluations,id',
            'eleve_id' => 'required|exists:eleves,id',
            'note' => [
                'required',
                'numeric',
                'between:0,20',
                'regex:/^\d{1,2}(\.\d{1,2})?$/',
            ],
        ], [
            'note.regex' => 'La note doit être un nombre décimal valide avec jusqu\'à deux chiffres après la virgule.',
        ]);

        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluation_eleve->update($validatedData);

        return redirect()->route('evaluations_eleves.index')->with('success', 'Évaluation  d\'élève mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluation_eleve->delete();

        return redirect()->route('evaluations_eleves.index')->with('success', 'Évaluation d\'élève supprimée avec succès.');
    }

    public function showNotes(string $evaluationId)
    {
        $notes = EvaluationEleve::with(['eleve', 'evaluation'])
            ->where('evaluation_id', $evaluationId)
            ->get();

        return view('evaluations_eleves.notes', compact('notes', 'evaluationId'));
    }

    public function showNuls(string $evaluationId)
    {
        $nuls = EvaluationEleve::with(['eleve','evaluation'])
            ->whereHas('evaluation', function ($query) use ($evaluationId) {
                $query->where('evaluation_id', $evaluationId)
                      ->where('note', '<', 10);
            })
            ->get();

        return view('evaluations_eleves.nuls', compact('nuls', 'evaluationId'));
    }
}
