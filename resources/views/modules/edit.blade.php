@extends('layouts.app')
@section('content')
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Modifier le Module : {{ $module->code }}</h1>

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('modules.update', $module->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Code du module :</label>
                <input type="text" id="code" name="code" 
                       value="{{ $module->code }}" 
                       required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom du module :</label>
                <input type="text" id="nom" name="nom" 
                       value="{{ $module->nom }}" 
                       required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="mt-4">
                <button type="submit" 
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                    Mettre à jour
                </button>
            </div>
        </form>

        @if ($errors->any())
            <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4 text-red-700">
                <p class="font-bold">Erreurs :</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-white">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
@endsection
