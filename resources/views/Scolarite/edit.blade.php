
@extends('layouts.template')
@section('styles')
<style>
.matable {
    width: 100% !important;
    border-collapse: collapse!important;
    padding: 10px!important;
    margin: 10px 0!important;
    font-family: Arial, sans-serif!important;
    font-size: 14px!important;
}

.matable th, .matable td {
    border: 1px solid #ccc!important;
    padding: 8px 12px!important;
    text-align: left!important;
}

.matable th {
    background-color:rgb(60, 141, 240)!important;
    font-weight: bold!important;
}

.matable tr:nth-child(even) {
    background-color: #f9f9f9!important;
}

.matable tr:hover {
    background-color:rgba(14, 113, 162, 0.35)!important;
}

/* Responsive table */
@media (max-width: 767.98px) {
    .matable, .matable thead, .matable tbody, .matable th, .matable td, .matable tr {
        display: block !important;
        width: 100% !important;
    }
    .matable thead tr {
        display: none !important;
    }
    .matable td {
        border: none !important;
        position: relative !important;
        padding-left: 50% !important;
        min-height: 40px;
    }
    .matable td:before {
        position: absolute;
        top: 0;
        left: 10px;
        width: 45%;
        white-space: nowrap;
        font-weight: bold;
        color: #2980b9;
        content: attr(data-label);
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            <h4>{{ __('Détail des règlements') }}</h4>
        </div>
    </div>

    <div class="row mt-4 ">
        {{-- Informations sur l'élève (à gauche) --}}
        <div class="col-md-6 col-12  mb-4">
            <fieldset class="p-3 mb-2 h-auto">
                <legend class="w-auto h-auto">{{ __('Informations de l\'élève') }}</legend>
                <div class="text-center mb-3">
                    <img src="{{ $eleve->Photo }}" alt="Photo de {{ $eleve->Nom }}" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
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
        <div class="col-md-6 col-12 mb-4">
            <fieldset class="p-3 mb-2">
                <legend class="w-auto">{{ __('Détails des paiements') }}</legend>
                <div class="form-group">
                    <label>{{ __('Montant total à payer') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($inscription->montantscolariteE, 2) }} FCFA" disabled>
                </div>
                <div class="form-group">
                    <label>{{ __('Montant total payé') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($total_regle, 2) }} FCFA" disabled>
                </div>
                <div class="form-group">
                    <label>{{ __('Reste à payer') }}</label>
                    <input type="text" class="form-control" value="{{ number_format($reste, 2) }} FCFA" disabled>
                </div>

                {{-- Détails des paiements --}}
                <h4>{{ __('Historique des paiements') }}</h4>
                <div style="max-height: 280px; overflow-y: auto;">
                    <table class="table table-bordered matable">
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
                                    <td data-label="{{ __('Date') }}">{{ $reglement->created_at->isoFormat('LLL') }}</td>
                                    <td data-label="{{ __('Montant') }}">{{ number_format($reglement->montant, 2) }} FCFA</td>
                                    <td data-label="{{ __('Mode de paiement') }}">{{ $reglement->banque->libellebanque }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection