<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // Méthode pour afficher la liste des modules
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    // Méthode pour afficher le formulaire de création
    public function create()
    {
        return view('modules.create'); // Affiche la vue create.blade.php
    }

    // Méthode pour enregistrer un nouveau module
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:modules',
            'nom' => 'required|string|max:255',
        ]);

        Module::create($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module ajouté avec succès.');
    }

    // Méthode pour afficher le formulaire de modification
    public function edit($id)
    {        
        $module = Module::findOrFail($id);
        return view('modules.edit', compact('module'));
    }

    // Méthode pour mettre à jour un module existant
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:modules,code,' . $id,
            'nom' => 'required|string|max:255',
        ]);

        $module = Module::findOrFail($id);
        $module->update($validatedData);

        return redirect()->route('modules.index')->with('success', 'Module mis à jour avec succès.');
    }

    // Méthode pour supprimer un module
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
