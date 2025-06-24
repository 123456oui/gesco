@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="main-card card">
        <div class="card-header py-0">
         
            <h4>{{ __(' Montant Mensuel de la Cantine ') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Montant Mensuel')}} </th>
                    @php echo $controler->crudheader($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
                @foreach($cantineannes as $item)
                    <tr>
                        <td>{{$item->montant_mois}}</td>
                        
                        @php $route = 'route';                       
                        echo $controler->crudbody($rub,$srub,$route,'paramcantine.edit','paramcantine.destroy',$item->id);
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