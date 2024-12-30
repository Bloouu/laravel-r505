<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    public function show($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }
    
    public function create()
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        return view('modules.create'); 
    }
    
    public function store(Request $request)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:modules',
            'nom' => 'required|string|max:255',
        ]);

        Module::create($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module ajouté avec succès.');
    }
    
    public function edit($id)
    {        
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $module = Module::findOrFail($id);
        return view('modules.edit', compact('module'));
    }

    
    public function update(Request $request, $id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:modules,code,' . $id,
            'nom' => 'required|string|max:255',
        ]);

        $module = Module::findOrFail($id);
        $module->update($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module mis à jour avec succès.');
    }

    
    public function destroy($id)
    {
        if (auth()->user()->isEleve()) {
            return redirect()->route('dashboard')->with('error', 'Cette fonctionnalité est réservée aux professeurs');
        }
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
