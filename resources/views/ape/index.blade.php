@extends('layouts.template')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">{{ __('BILAN APE PAR DATE') }}</h5>
                </div>

                <div class="card-body">
                    <form class="needs-validation" novalidate method="GET" 
                          action="{{ route('ape.edit', ['rub' => $rub, 'srub' => $srub]) }}">
                        @csrf

                        <!-- Champs cachés -->
                        <input type="hidden" name="rub" value="{{ $rub }}">
                        <input type="hidden" name="srub" value="{{ $srub }}">

                        <!-- Date début -->
                        <div class="mb-3">
                            <label for="datedebut" class="form-label">
                                {{ __('Date Début :') }} <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="datedebut" id="datedebut"
                                   class="form-control @error('datedebut') is-invalid @enderror"
                                   value="{{ old('datedebut') }}" required>
                        </div>

                        <!-- Date fin -->
                        <div class="mb-3">
                            <label for="datefin" class="form-label">
                                {{ __('Date Fin :') }} <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="datefin" id="datefin"
                                   class="form-control @error('datefin') is-invalid @enderror"
                                   value="{{ old('datefin') }}" required>
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
