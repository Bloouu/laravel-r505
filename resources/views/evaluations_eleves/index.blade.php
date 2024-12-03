@extends('layouts.app')
@section('content')
<body class="bg-gray-100">
<div class="container mx-auto p-4">
        <h1 class="text-3xl text-white font-bold text-center mb-6">Liste des Évaluations des Élèves</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('evaluations_eleves.create') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Ajouter une Évaluation</a>
        </div>
        
        <table class="table-auto w-full bg-white shadow-md rounded-lg border border-gray-200">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Nom Élève</th>
                    <th class="px-4 py-2">Prénom Élève</th>
                    <th class="px-4 py-2">Titre Eval</th>
                    <th class="px-4 py-2">Note</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($evaluations_eleves as $evaluationEleve)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 text-center border">{{ $evaluationEleve->eleve->nom }}</td>
                        <td class="px-4 py-2 text-center border">{{ $evaluationEleve->eleve->prenom }}</td>
                        <td class="px-4 py-2 text-center border">{{ $evaluationEleve->evaluation->titre }}</td>
                        <td class="px-4 py-2 text-center border">{{ $evaluationEleve->note }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('evaluations_eleves.edit', $evaluationEleve->id) }}" class="text-blue-500 hover:underline">Modifier</a>

                            <form action="{{ route('evaluations_eleves.destroy', $evaluationEleve->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="text-red-500 hover:underline ml-2" onclick="return confirm('Voulez-vous vraiment supprimer cette évaluation ?')">Supprimer</button>
                            </form>
                            
                            <a href="{{ route('evaluations_eleves.notes', $evaluationEleve->evaluation_id) }}" class="text-green-500 hover:underline ml-2">Voir notes</a>

                            <a href="{{ route('evaluations_eleves.nuls', $evaluationEleve->evaluation_id) }}" class="text-pink-500 hover:underline ml-2">Voir nuls</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection