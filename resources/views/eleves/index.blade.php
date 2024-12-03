@extends('layouts.app')

@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl text-white font-bold text-center mb-6">Liste des Élèves</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('eleves.create') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Ajouter un Élève</a>
        </div>

        <table class="table-auto w-full bg-white shadow-md rounded-lg border border-gray-200">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Prénom</th>
                    <th class="px-4 py-2">Numéro d'Étudiant</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($eleves as $eleve)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 text-center border">{{ $eleve->id }}</td>
                        <td class="px-4 py-2 text-center border">{{ $eleve->nom }}</td>
                        <td class="px-4 py-2 text-center border">{{ $eleve->prenom }}</td>
                        <td class="px-4 py-2 text-center border">{{ $eleve->numero_etudiant }}</td>
                        <td class="px-4 py-2 text-center border">{{ $eleve->email }}</td>
                        <td class="px-4 py-2 text-center border">{{ $eleve->image }}</td>
                        <td class="px-4 py-2 text-center border">
                            <a href="{{ route('eleves.edit', $eleve->id) }}" class="text-blue-500 hover:underline">Modifier</a>
                            
                            <form action="{{ route('eleves.destroy', $eleve->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Voulez-vous vraiment supprimer cet élève ?');">Supprimer</button>
                            </form>
                            
                            <a href="{{ route('eleves.notes', $eleve->id) }}" class="text-green-500 hover:underline ml-2">Voir Notes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection
