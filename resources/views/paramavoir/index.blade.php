@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
            @php echo $controler->newFormButton($rub,$srub,'paramavoir.create'); @endphp
            <h4>{{ __('Liste des Avoirs') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Avoirs')}} </th>
                    <th>{{__('Montant')}} </th>
                    @php echo $controler->crudheader($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
                @foreach($avoirs as $item)
                    <tr>
                        <td>{{$item->libellepers}}</td>
                         <td>{{$item->montant}}</td>

                        @php $route = 'route';                       
                        echo $controler->crudbody($rub,$srub,$route,'paramavoir.edit','paramavoir.destroy',$item->id);
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