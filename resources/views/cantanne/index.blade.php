@extends('layouts.template')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">{{ __('BILAN DE LA CANTINE ') }}</h5>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate method="GET" 
                          action="{{ route('cantanne.edit', ['rub' => $rub, 'srub' => $srub]) }}">
                        @csrf

                        <!-- Champs cachés -->
                        <input type="hidden" name="rub" value="{{ $rub }}">
                        <input type="hidden" name="srub" value="{{ $srub }}">

                        <!-- Date début -->
                          <div class="mb-3">
                            <label for="moisdebut" class="form-label">
                                {{ __('Mois Début :') }} <span class="text-danger">*</span>
                            </label>
                            <select name="moisdebut" id="moisdebut" class="form-control" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($mois as $moi)
                                    <option value="{{ $moi->id }}">{{ $moi->nom_mois }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mois fin -->
                        <div class="mb-3">
                            <label for="moisfin" class="form-label">
                                {{ __('Mois Fin :') }} <span class="text-danger">*</span>
                            </label>
                            <select name="moisfin" id="moisfin" class="form-control" required>
                                <option value="">-- Sélectionner --</option>
                                 @foreach($mois as $moi)
                                    <option value="{{ $moi->id }}">{{ $moi->nom_mois }}</option>
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
