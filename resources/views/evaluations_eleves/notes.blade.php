@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-3xl text-white font-bold text-center mb-6">Notes pour l'Évaluation ID: {{ $evaluationId }}</h1>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <table class="table-auto border-collapse border border-gray-200 w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Nom Élève</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Prénom Élève</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notes as $note)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $note->eleve->nom }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $note->eleve->prenom }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $note->note }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="mt-4 bg-yellow-200 text-yellow-800 p-3 rounded-lg">Aucune note disponible pour cette évaluation.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection