@extends('layouts.app')
@section('content')
<body>
    <h1 class="text-3xl text-white font-bold text-center mb-6">Ajouter une Évaluation</h1>


    <form action="{{ route('evaluations.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="titre" class="block text-gray-700 font-bold mb-2">Titre :</label>
            <input type="text" id="titre" name="titre" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-bold mb-2">Date :</label>
            <input type="date" id="date" name="date" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="coefficient" class="block text-gray-700 font-bold mb-2">Coefficient :</label>
            <input type="number" id="coefficient" name="coefficient" step="0.01" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="module_id">Module :</label>
            <select id="module_id" name="module_id" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">Ajouter Évaluation</button>
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
</html>
@endsection