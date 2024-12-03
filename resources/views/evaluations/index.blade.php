@extends('layouts.app')
@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl text-white font-bold text-center mb-6">Liste des Évaluations</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('evaluations.create') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Ajouter une nouvelle évaluation</a>
        </div>

        <table class="table-auto w-full bg-white shadow-md rounded-lg border border-gray-200">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Titre</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Coefficient</th>
                    <th class="px-4 py-2">ID du Module</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($evaluations as $eval)
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="px-4 py-2 text-center">{{ $eval->id }}</td>
                        <td class="px-4 py-2 text-center">{{ $eval->titre }}</td>
                        <td class="px-4 py-2 text-center">{{ $eval->date }}</td>
                        <td class="px-4 py-2 text-center">{{ $eval->coefficient }}</td>
                        <td class="px-4 py-2 text-center">{{ $eval->module_id }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('evaluations.edit', $eval->id) }}" class="text-blue-500 hover:underline">Modifier</a>
                            <form action="{{ route('evaluations.destroy', $eval->id) }}" method="POST" class="text-blue-500 hover:underline inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Voulez-vous vraiment supprimer cette évaluation ?');">Supprimer</button>
                            </form>
                            <button class="text-green-500 hover:underline ml-2 inline-block">
                                <a href="{{ route('evaluations_eleves.notes', $eval->id) }}"  >Voir notes</a>
                            </button>
                            <button class="text-pink-500 hover:underline ml-2">
                                <a href="{{ route('evaluations_eleves.nuls', $eval->id) }}" >Voir nuls</a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection