@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center mx-5">
    <div class="w-full max-w-md p-4 shadow-md rounded-lg">
        <h2 class="text-white text-2xl font-bold text-center mb-6">Connexion</h2>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-300">Email</label>
                <input id="email" type="email" name="email" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-300">Mot de passe</label>
                <input id="password" type="password" name="password" class="w-full mt-1 p-2 border border-gray-300 rounded-lg" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-blue-500">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Se connecter</button>
        </form>
    </div>
</div>
@endsection
