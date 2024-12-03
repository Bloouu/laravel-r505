@extends('layouts.app')
@section('content')
<body>
    <h1 class="text-3xl text-white font-bold text-center mb-6">Ajouter un Élève</h1>

    <form action="{{ route('eleves.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom :</label>
            <input type="text" id="nom" name="nom" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom :</label>
            <input type="text" id="prenom" name="prenom" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="numero_etudiant" class="block text-gray-700 font-bold mb-2">Numéro d'Étudiant :</label>
            <input type="text" id="numero_etudiant" name="numero_etudiant" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email :</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Image (URL ou chemin) :</label>
            <input type="text" id="image" name="image" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">Ajouter Élève</button>
        </div>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
@endsection