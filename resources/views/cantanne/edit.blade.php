@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0 position-relative text-center">
    <h4 class="w-100 m-0">{{ __('Liste des élèves inscrits a la cantine') }}</h4>

    {{-- Bouton imprimer aligné à droite --}}
    <form action="{{ route('cantanne.imprimer') }}" method="POST"  style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
        @csrf
        <input type="hidden" name="moisdebut" value="{{ $moisDebutNom }}">
        <input type="hidden" name="moisfin" value="{{$moisFinNom}}">
        <input type="hidden" name="eleves_json" value='@json($cantines)'>
        <input type="hidden" name="rub" value="{{ $rub}}">
        <input type="hidden" name="srub" value="{{ $srub}}">
        <input type="hidden" name="total" value="{{ number_format($somme, 0, ',', ' ') }}">
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-print"></i> Imprimer
        </button>
    </form>
</div>

        <div class="card-body table-responsive">
            <table id="example" class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>{{ __('Matricule') }}</th>
                        <th>{{ __('Nom complet') }}</th>
                        <th>{{ __('Montant ') }}</th>
                        <th>{{ __('nombre de mois') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cantines as $eleve)
                        <tr>
                            <td>{{ $eleve->matricule }}</td>
                            <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                            <td>{{ number_format($eleve->montant, 0, ',', ' ') }} F</td>
                            <td>{{ $eleve->nombre_fois }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-muted text-right mx-5">Total cantines : {{ number_format($somme, 0, ',', ' ') }} F</p>
        </div>
    </div>
</div>
@endsection
