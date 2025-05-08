@extends('layouts.template')

@section('content')
<div class="container">
    <div class="main-card card">
        <div class="card-header py-0">
            <h4>{{ __('Détail des règlements') }}</h4>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Informations sur l'élève (à gauche) --}}
        <div class="col-md-6">
            <fieldset class=" p-3 mb-2">
                <legend class="w-auto">{{ __('Informations de l\'élève') }}</legend>
                <div class="text-center mb-3">
                    <img src="{{ $eleve->Photo }}" alt="Photo de {{ $eleve->Nom }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <div class="form-group">
                    <label for="matricule">{{ __('Matricule') }}</label>
                    <input type="text" id="matricule" class="form-control" value="{{ $eleve->Matricule }}" disabled>
                </div>
                <div class="form-group">
                    <label for="nom">{{ __('Nom') }}</label>
                    <input type="text" id="nom" class="form-control" value="{{ $eleve->Nom }}" disabled>
                </div>
                <div class="form-group">
                    <label for="prenom">{{ __('Prénom') }}</label>
                    <input type="text" id="prenom" class="form-control" value="{{ $eleve->Prenom }}" disabled>
                </div>
                <div class="form-group">
                    <label for="date_naissance">{{ __('Date de naissance') }}</label>
                    <input type="text" id="date_naissance" class="form-control" value="{{ $eleve->datenais }}" disabled>
                </div>
                <div class="form-group">
                    <label for="numero_naissance">{{ __('Numéro d\'acte de naissance') }}</label>
                    <input type="text" id="numero_naissance" class="form-control" value="{{ $eleve->numbactnaiss }}" disabled>
                </div>
            </fieldset>
        </div>

        {{-- Informations des règlements (à droite) --}}
        <div class="col-md-6">
            <fieldset class="p-3 mb-2">
                <legend class="w-auto">{{ __('Détails des paiements') }}</legend>
                <div class="form-group">
                    <label>{{ __('Montant total à payer') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($inscription->montantscolariteE, 2) }} €" disabled>
                </div>
                <div class="form-group">
                    <label>{{ __('Montant total payé') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($total_regle, 2) }} €" disabled>
                </div>
                <div class="form-group">
                    <label>{{ __('Reste à payer') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($reste, 2) }} €" disabled>
                </div>

                {{-- Détails des paiements --}}
                <h4>{{ __('Historique des paiements') }}</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Montant') }}</th>
                            <th>{{ __('Mode de paiement') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reglements as $reglement)
                            <tr>
                                <td>{{ $reglement->date_reglement }}</td>
                                <td>{{ number_format($reglement->montant, 2) }} €</td>
                                <td>{{ $reglement->mode_paiement }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</div>
@endsection
