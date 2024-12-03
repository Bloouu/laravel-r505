@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier une Évaluation d'Élève</h1>
    
    <form action="{{ route('evaluationeleves.update', $evaluationEleve->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="evaluation_id">ID Évaluation</label>
            <input type="number" name="evaluation_id" id="evaluation_id" class="form-control" value="{{ $evaluationEleve->evaluation_id }}" required>
        </div>

        <div class="form-group">
            <label for="eleve_id">ID Élève</label>
            <input type="number" name="eleve_id" id="eleve_id" class="form-control" value="{{ $evaluationEleve->eleve_id }}" required>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input type="number" name="note" id="note" class="form-control" value="{{ $evaluationEleve->note }}" required step="0.25">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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