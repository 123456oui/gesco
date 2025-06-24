@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'paramretenue.create'); @endphp
            <h4>{{ __('Liste des RetenueS') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Retenue')}} </th>
                    <th>{{__('Montant')}} </th>
                    @php echo $controler->crudheader($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
                @foreach($retenuepers as $item)
                    <tr>
                        <td>{{$item->libellepers}}</td>
                         <td>{{$item->montant}}</td>

                        @php $route = 'route';                       
                        echo $controler->crudbody($rub,$srub,$route,'paramretenue.edit','paramretenue.destroy',$item->id);
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