<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\EvaluationEleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    public function index()
    {
        $eleves = Eleve::all();
        return view('eleves.index', compact('eleves'));
    }

    public function create()
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        return view('eleves.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
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

    public function edit($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $eleve = Eleve::findOrFail($id);
        return view('eleves.edit', compact('eleve'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
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

    public function destroy($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        return redirect()->route('eleves.index')->with('success', 'Éleve supprimé avec succès.');
    }

    public function showNotes($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $notes = EvaluationEleve::with('eleve')
            ->where('eleve_id', $id)
            ->get();

        return view('eleves.notes', compact('notes', 'id'));
    }
}
