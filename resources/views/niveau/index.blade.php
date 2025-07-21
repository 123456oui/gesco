@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'niveau.create'); @endphp
            <h4>{{ __('Liste des Niveaux') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Année')}} </th>
                    <th>{{__('Niveau')}} </th>
                    <th>{{__('Montant Scolarité')}} </th>
                    <th>{{__('Montant Cantine')}} </th>

                    @php echo $controler->crudheader($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
                @foreach($niveaus as $item)
                    <tr>
                        <td>{{$item->annee}}</td>
                        <td>{{$item->libelleniveau}}</td>
                         
                        <td>{{$item->Montantscolarite}}</td>
                        <td>{{$item->montantcantine}}</td>
                        @php $route = 'route'; echo $controler->crudbody($rub,$srub,$route,'niveau.edit','niveau.destroy',$item->id); @endphp
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