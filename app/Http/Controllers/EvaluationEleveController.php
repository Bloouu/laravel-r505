<?php

namespace App\Http\Controllers;

use App\Models\EvaluationEleve;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\NoteAjoutNotif;
use Illuminate\Support\Facades\Mail;

class EvaluationEleveController extends Controller
{

    public function index()
    {
        $evaluations_eleves = EvaluationEleve::with(['eleve','evaluation'])->get();
        return view('evaluations_eleves.index', compact('evaluations_eleves'));

    }

    public function create()
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        return view('evaluations_eleves.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

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

        $note = EvaluationEleve::create($request->all());

        $noteDetails = [
            'nom' => $note->eleve->nom . ' ' . $note->eleve->prenom,
            'note' => $note->note,
            'evaluation' => $note->evaluation->titre,
            'date' => $note->created_at->format('d/m/Y'),
        ];

        Mail::to($note->eleve->email)->send(new NoteAjoutNotif($noteDetails));

        return redirect()->route('evaluations_eleves.index')->with('success', 'Évaluation d\'éleve ajoutée avec succès.');
    }

    public function show(string $id)
    {
        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluations = Evaluation::all();
        $eleves = Eleve::all(); 
        return view('evaluations_eleves.edit', compact('evaluation_eleve', 'evaluations', 'eleves'));
    }

    public function edit(string $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluations = Evaluation::all();
        $eleve = Eleve::all();

        return view('evaluations_eleves.edit', compact('evaluation_eleves', 'evaluations', 'eleves'));
    }

    public function update(Request $request, string $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

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

    public function destroy(string $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $evaluation_eleve = EvaluationEleve::findOrFail($id);
        $evaluation_eleve->delete();

        return redirect()->route('evaluations_eleves.index')->with('success', 'Évaluation d\'élève supprimée avec succès.');
    }

    public function showNotes(string $evaluationId)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $notes = EvaluationEleve::with(['eleve', 'evaluation'])
            ->where('evaluation_id', $evaluationId)
            ->get();

        return view('evaluations_eleves.notes', compact('notes', 'evaluationId'));
    }

    public function showNuls(string $evaluationId)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $nuls = EvaluationEleve::with(['eleve','evaluation'])
            ->whereHas('evaluation', function ($query) use ($evaluationId) {
                $query->where('evaluation_id', $evaluationId)
                      ->where('note', '<', 10);
            })
            ->get();

        return view('evaluations_eleves.nuls', compact('nuls', 'evaluationId'));
    }
}
