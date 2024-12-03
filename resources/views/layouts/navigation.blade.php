<header class="bg-blue-500 text-white py-4 px-4 mb-4 shadow-md">
    <div class="container flex justify-between items-center">
        <h1 class="text-xl font-bold"><a href="{{ url('/') }}">Mon Application</a></h1>
        <nav class="space-x-4">
            <a href="{{ route('eleves.index') }}" class="hover:underline">Élèves</a>
            <a href="{{ route('evaluations.index') }}" class="hover:underline">Évaluations</a>
            <a href="{{ route('modules.index') }}" class="hover:underline">Modules</a>
            <a href="{{ route('evaluations_eleves.index') }}" class="hover:underline">Évaluations Élèves</a>
        </nav>
    </div>
</header>