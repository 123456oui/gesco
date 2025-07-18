@extends('layouts.template')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                        <h5 class="mb-0">{{ __('Liste de Cloture PAR classe ') }}</h5>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate method="GET" 
                        action="{{ route('lcloture.edit', ['rub' => $rub, 'srub' => $srub]) }}">
                        @csrf

                        <!-- Champs cachés -->
                        <input type="hidden" name="rub" value="{{ $rub }}">
                        <input type="hidden" name="srub" value="{{ $srub }}">

                        <!-- Sélection du niveau -->
                        <div class="mb-3">
                            <label for="niveau" class="form-label">
                                {{ __('Niveau :') }} <span class="text-danger">*</span>
                            </label>
                            <select name="niveau" id="niveau" class="form-control @error('niveau') is-invalid @enderror" onchange="filtrerClassesParNiveau(this.value)">
                                <option value="">-- Sélectionner le niveau --</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" {{ old('niveau') == $niveau->id ? 'selected' : '' }}>{{ $niveau->libelleniveau }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sélection de la classe -->
                        <div class="mb-3">
                            <label for="classe" class="form-label">
                                {{ __('Classe :') }} <span class="text-danger">*</span>
                            </label>
                            <select name="classe" id="classe" class="form-control @error('classe') is-invalid @enderror" required>
                                <option value="">-- Sélectionner la classe --</option>
                                @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}" {{ old('classe') == $classe->id ? 'selected' : '' }}>{{ $classe->libelleclasse }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="text-center mt-4">
                            <input type="submit" id="valider" value="{{ __('rechercher') }}"
                                   class="btn btn-primary px-5" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function filtrerClassesParNiveau(niveauId) {
    const classeSelect = document.getElementById('classe');
    classeSelect.innerHTML = '<option value="">-- Chargement... --</option>';

    if (!niveauId) {
        classeSelect.innerHTML = '<option value="">-- Sélectionner la classe --</option>';
        return;
    }

    fetch(`/get-classes/${niveauId}`)
        .then(response => response.json())
        .then(data => {
            classeSelect.innerHTML = '<option value="">-- Sélectionner la classe --</option>';
            data.forEach(classe => {
                const option = document.createElement('option');
                option.value = classe.id;
                option.textContent = classe.libelleclasse;
                classeSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des classes :', error);
            classeSelect.innerHTML = '<option value="">-- Erreur de chargement --</option>';
        });
}
</script>

@endsection
