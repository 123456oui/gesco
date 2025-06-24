@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0 position-relative text-center">
    <h4 class="w-100 m-0">{{ __('Liste des élèves impayés') }}</h4>

    {{-- Bouton imprimer aligné à droite --}}
    <form action="{{ route('impayes.imprimer') }}" method="POST"  style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
        @csrf
        <input type="hidden" name="classe" value="{{ $classe->libelleclasse }}">
        <input type="hidden" name="annee" value="{{ $annee }}">
        <input type="hidden" name="eleves_json" value='@json($eleves)'>
        <input type="hidden" name="rub" value="{{ $rub}}">
        <input type="hidden" name="srub" value="{{ $srub}}">
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
                        <th>{{ __('Montant dû') }}</th>
                        <th>{{ __('Montant payé') }}</th>
                        <th>{{ __('Reste à payer') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eleves as $eleve)
                        @php
                            $montant_total = DB::table('inscriptions')
                                ->where('Matricule', $eleve->Matricule)
                                ->where('idanneescolaire', $annee)
                                ->value('montantscolariteE');

                            $montant_paye = DB::table('reglements')
                                ->where('id_eleve', $eleve->Matricule)
                                ->where('annee', $annee)
                                ->sum('montant');

                            $reste = $montant_total - $montant_paye;
                        @endphp
                        <tr>
                            <td>{{ $eleve->Matricule }}</td>
                            <td>{{ $eleve->Nom }} {{ $eleve->Prenom }}</td>
                            <td>{{ number_format($montant_total, 0, ',', ' ') }} F</td>
                            <td>{{ number_format($montant_paye, 0, ',', ' ') }} F</td>
                            <td><strong style="color:red">{{ number_format($reste, 0, ',', ' ') }} F</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
