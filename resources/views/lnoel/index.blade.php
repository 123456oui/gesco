@extends('layouts.template')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                        <h5 class="mb-0">{{ __('Liste des   NOEL PAR classe ') }}</h5>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate method="GET" 
                        action="{{ route('lnoel.edit', ['rub' => $rub, 'srub' => $srub]) }}">
                        @csrf

                        <!-- Champs cachés -->
                        <input type="hidden" name="rub" value="{{ $rub }}">
                        <input type="hidden" name="srub" value="{{ $srub }}">

                        <!-- Sélection du niveau -->
                        <div class="mb-3">
                            <label for="niveau" class="form-label">
                                {{ __('Niveau :') }} <span class="text-danger">*</span>
                            </label>
                            <select name="niveau" id="niveau" class="form-control @error('niveau') is-invalid @enderror" required>
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
@endsection
