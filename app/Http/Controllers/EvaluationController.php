<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Module;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    
    public function index()
    {
        $evaluations = Evaluation::with('module')->get();
        return view('evaluations.index', compact('evaluations'));
    }

    
    public function create()
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $modules = Module::all(); 
        return view('evaluations.create', compact('modules'));
    }

    
    public function store(Request $request)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'coefficient' => 'required|numeric',
            'module_id' => 'required|exists:modules,id',
        ]);

        Evaluation::create($validatedData);

        return redirect()->route('evaluations.index')->with('success', 'Évaluation ajoutée avec succès.');
    }

    
    public function edit($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $evaluation = Evaluation::findOrFail($id);
        $modules = Module::all();
        return view('evaluations.edit', compact('evaluation', 'modules'));
    }

    
    public function update(Request $request, $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

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

    
    public function destroy($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }

        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès.');
    }
}
