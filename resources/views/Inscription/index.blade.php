@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'Eleve.create'); @endphp
            <h4>{{ __('Liste des eleves') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Matricule Eleve')}} </th>
                    <th>{{__('Nom Eleve')}} </th>
                    <th>{{__('Prenom Eleve')}} </th>
                    <th>{{__('Nom Pere')}} </th>
                    <th>{{__('Nom Mere')}} </th>
                    <th>{{__('Date de naissance')}} </th>
                    <th>{{__('numero Naissance')}} </th>
                    <th>{{__('Photo Eleve')}} </th>
                
                    @php echo $controler->crudheaderm($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
            @foreach($eleves as $item)
                <tr style="height: 250px;">
                    <td>{{$item->Matricule}}</td>
                    <td>{{$item->Nom}}</td>
                    <td>{{$item->Prenom}}</td>
                    <td>{{$item->Nomp}}</td>
                    <td>{{$item->Nomm}}</td>
                    <td>{{$item->datenais}}</td>
                    <td>{{$item->numbactnaiss}}</td>
                    <td>
                        <img src="{{ $item->Photo }}" 
                            alt="Photo de {{ $item->Nom }}" 
                            style="height: 250px; width: 250px; object-fit: cover; border-radius: 50%; display: block; margin: auto;">
                    </td>
                    @php
                        $route = 'route';
                        echo $controler->crudbodym($rub,$srub,$route,'Eleve.edit',$item->Matricule);
                    @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
    {{-- <a href="/exportExcelCause" >
        <button class="btn btn-primary btnEnregistrer">{{ __('liste.exporter') }}</button>
    </a> --}}
</div>
@endsection