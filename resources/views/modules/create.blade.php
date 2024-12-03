@extends('layouts.app')
@section('content')
<body>
    <h1 class="text-3xl text-white font-bold text-center mb-6">Ajouter un nouveau module</h1>
    <form action="{{ route('modules.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label for="code" class="block text-gray-700 font-bold mb-2">Code du module :</label>
        <input type="text" id="code" name="code" 
            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            required>
    </div>
    <div class="mb-4">
        <label for="nom" class="block text-gray-700 font-bold mb-2">Nom du module :</label>
        <input type="text" id="nom" name="nom" 
            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            required>
    </div>
    <div class="mt-4">
        <button type="submit" 
            class="bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">
            Ajouter Module
        </button>
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