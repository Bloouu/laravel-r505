@extends('layouts.app')

@section('content')
<div class="container">
    <h1  class="text-3xl text-white font-bold text-center mb-6">Ajouter une Évaluation d'Élève</h1>
    
    <form action="{{ route('evaluations_eleves.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="evaluation_id" class="block text-gray-700 font-bold mb-2">ID Évaluation</label>
            <input type="number" name="evaluation_id" id="evaluation_id" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="eleve_id" class="block text-gray-700 font-bold mb-2">ID Élève</label>
            <input type="number" name="eleve_id" id="eleve_id"  class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="note" class="block text-gray-700 font-bold mb-2">Note</label>
            <input type="number" name="note" id="note" step="0.25" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">Ajouter</button>
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
</div>
@endsection
