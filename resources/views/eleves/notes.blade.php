@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-white font-bold text-center mb-6">Notes de l'élève</h1>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <table class="table-auto border-collapse border border-gray-200 w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Note</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Date de l'évaluation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notes as $note)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $note->note }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $note->evaluation->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($notes->isEmpty())
            <div class="mt-4 bg-yellow-200 text-yellow-800 p-3 rounded-lg">
                <p>Aucune note disponible pour cet élève pour cette évaluation.</p>
            </div>
        @endif
    </div>
@endsection
