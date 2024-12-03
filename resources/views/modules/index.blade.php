@extends('layouts.app')
@section('content')
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl text-white font-bold text-center mb-6">Liste des Modules</h1>

    <div class="mb-4 text-center">
        <a href="{{ route('modules.create') }}" 
           class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
            Ajouter un nouveau module
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg border border-gray-200">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Code</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($modules as $module)
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="px-4 py-2 text-center">{{ $module->id }}</td>
                        <td class="px-4 py-2 text-center">{{ $module->code }}</td>
                        <td class="px-4 py-2 text-center">{{ $module->nom }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('modules.edit', $module->id) }}" 
                               class="text-blue-500 hover:underline">Modifier</a>
                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:underline ml-2"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce module ?');">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection
