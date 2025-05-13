@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="w-100 mb-4 px-5">
        <form method="GET" id="filterForm" class="col-md-6" action="{{ url('Scolarite/' . $rub . '/' . $srub) }}" >
                    <div class="form-group ">
                        <label for="etat" class="mr-2">{{ __('Statut paiement') }}</label>
                        <select name="etat" class="form-control" onchange="document.getElementById('filterForm').submit();">
                            <option value="">-- Tous --</option>
                            <option value="ajour" {{ request('etat') == 'ajour' ? 'selected' : '' }}>À jour</option>
                            <option value="impaye" {{ request('etat') == 'impaye' ? 'selected' : '' }}>Impayé</option>
                        </select>
                    </div>
                </form>
        </div>


    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'Scolarite.create'); @endphp
            <h4>{{ __('Liste des élèves') }}</h4>

            {{-- Formulaire de filtre par statut de paiement --}}
            
        </div>

        <div class="card-body table-responsive">
            <table id="example" class="table table-striped table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th>{{__('Matricule Eleve')}}</th>
                        <th>{{__('Nom Eleve')}}</th>
                        <th>{{__('Prenom Eleve')}}</th>
                        <th>{{__('Nom Pere')}}</th>
                        <th>{{__('Nom Mere')}}</th>
                        <th>{{__('Date de naissance')}}</th>
                        <th>{{__('Numero Naissance')}}</th>
                        <th>{{__('Photo Eleve')}}</th>
                        @php echo $controler->crudheaderm($rub,$srub); @endphp
                    </tr>
                </thead>
                <tbody>
                @foreach($eleves as $item)
                    <tr style="height: 250px;">
                        <td>{{ $item->Matricule }}</td>
                        <td>{{ $item->Nom }}</td>
                        <td>{{ $item->Prenom }}</td>
                        <td>{{ $item->Nomp }}</td>
                        <td>{{ $item->Nomm }}</td>
                        <td>{{ $item->datenais }}</td>
                        <td>{{ $item->numbactnaiss }}</td>
                        <td>
                            <img src="{{ $item->Photo }}" 
                                 alt="Photo de {{ $item->Nom }}" 
                                 style=" max-width: 100%; height: 250px; width: 250px; object-fit: cover; border-radius: 50%; display: block; margin: auto;">
                        </td>
                        @php
                            $route = 'route';
                            echo $controler->crudbodym($rub,$srub,$route,'Scolarite.edit',$item->Matricule);
                        @endphp
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
