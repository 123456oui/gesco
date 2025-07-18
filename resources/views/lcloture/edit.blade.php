@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0 position-relative text-center">
    <h4 class="w-100 m-0">{{ __('Liste des élèves impayés') }}</h4>

    {{-- Bouton imprimer aligné à droite --}}
    <form action="{{ route('ape.imprimer') }}" method="POST"  style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
        @csrf
        <input type="hidden" name="datedebut" value="{{ $dateDebut}}">
        <input type="hidden" name="datefin" value="{{$dateFin}}">
        <input type="hidden" name="eleves_json" value='@json($reglementsParMatricule)'>
        <input type="hidden" name="rub" value="{{ $rub}}">
        <input type="hidden" name="srub" value="{{ $srub}}">
        <input type="hidden" name="total" value="{{ number_format(5000 * $reglementsParMatricule->count(), 0, ',', ' ') }}">
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
                        <th>{{ __('Scolarite verse ') }}</th>
                        <th>{{ __('APE') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reglementsParMatricule as $eleve)
                        <tr>
                            <td>{{ $eleve->Matricule }}</td>
                            <td>{{ $eleve->Nom }} {{ $eleve->Prenom }}</td>
                            <td>{{ number_format($eleve->total, 0, ',', ' ') }} F</td>
                            <td>{{ number_format(5000, 0, ',', ' ') }} F</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-muted text-right mx-5">Total APE : {{ number_format(5000 * $reglementsParMatricule->count(), 0, ',', ' ') }} F</p>
        </div>
    </div>
</div>
@endsection
