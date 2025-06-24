@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                {{-- En-tête de la carte --}}
                <div class="card-header py-0">
                    {{ __('Les Impayés pour l\'année en cours') }}
                </div>

                {{-- Corps du formulaire --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('impaye.rechercher') }}" class="needs-validation" novalidate>
                        @csrf

                        {{-- Groupe : Niveau et Classe --}}
                        <div class="form-group row">

                            {{-- Label + Select Niveau --}}
                            <label class="col-md-2 col-form-label text-md-right">
                                {{ __('Niveau') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                <select name="niveau_id" class="form-control @error('niveau_id') is-invalid @enderror" id="niveau_id" onchange="filtrerClasses()" >
                                    <option value="">{{ __('Sélectionner un niveau') }}</option>
                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                            {{ $niveau->libelleniveau }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('niveau_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- Label + Select Classe --}}
                            <label class="col-md-2 col-form-label text-md-right">
                                {{ __('Classe') }} <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                <select name="classe_id" id="classe_id" class="form-control @error('classe_id') is-invalid @enderror" required>
                                    <option value="">{{ __('Sélectionner une classe') }}</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                            {{ $classe->libelleclasse }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('classe_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                        </div>
                         <input type="hidden" name="rub" value={{$rub}} >
                        <input type="hidden" name="srub" value={{$srub}} >

                        {{-- Boutons --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <input type="submit" id="valider" value="{{ __('Valider ') }}" class="btn btn-primary btnEnregistrer" />
                            </div>
                        </div>

                    </form>
                </div> {{-- /card-body --}}

            </div> {{-- /card --}}
        </div>
    </div>
</div>

<script>
    const classes = @json($classes);

    function filtrerClasses() {
        const niveauSelect = document.getElementById('niveau_id');
        const classeSelect = document.getElementById('classe_id');
        const selectedNiveauId = parseInt(niveauSelect.value);

        // Vider la liste des classes
        classeSelect.innerHTML = '<option value="">Sélectionner une classe</option>';

        if (!isNaN(selectedNiveauId)) {
            const filtered = classes.filter(c => c.idniveau === selectedNiveauId);

            filtered.forEach(classe => {
                const option = document.createElement('option');
                option.value = classe.id;
                option.textContent = classe.libelleclasse;
                classeSelect.appendChild(option);
            });
        }
    }
</script>

@endsection
