@extends('layouts.template')

@section('content')
<div class="container-fluid">
<div class="d-flex justify-content-center">
    <div class="w-100 mb-4 px-5">
        <form method="GET" action="{{ url('Eleve/' . $rub . '/' . $srub) }}" class="row g-3 align-items-end" id="filterForm">
            <input type="hidden" name="rub" value="{{ $rub }}">
            <input type="hidden" name="srub" value="{{ $srub }}">

            <div class="col-md-4">
                <label for="cycle" class="form-label">Cycle</label>
                <select name="cycle" class="form-select" onchange="onCycleChange(this.value)">
                    <option value="">-- Cycle --</option>
                    @foreach($cycles as $cycle)
                        <option value="{{ $cycle->id }}" {{ request('cycle') == $cycle->id ? 'selected' : '' }}>{{ $cycle->libellecycle }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="niveau" class="form-label">Niveau</label>
                <select name="niveau" class="form-select" onchange="onNiveauChange(this.value)">
                    <option value="">-- Niveau --</option>
                    @foreach($niveaux as $niveau)
                        <option value="{{ $niveau->id }}" {{ request('niveau') == $niveau->id ? 'selected' : '' }}>{{ $niveau->libelleniveau }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe" class="form-select" onchange="onClasseChange()">
                    <option value="">-- Classe --</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ request('classe') == $classe->id ? 'selected' : '' }}>{{ $classe->libelleclasse }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1 text-end" style="background:transparant;">
                <label class="form-label d-block">&nbsp;</label>
                <a href="{{ url('Eleve/' . $rub . '/' . $srub) }}" class="btn btn-primary w-100" title="Réinitialiser">
                    <i class="fas fa-rotate-left"></i>
                </a>

            </div>
        </form>
        </div>
    </div>
    <div class="main-card card">
        <div class="card-header py-0" >
            @php echo $controler->newFormButton($rub,$srub,'Eleve.create'); @endphp
            <h4>{{ __('Liste des eleves') }}</h4>
        </div>
    <div class="card-body table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover dataTable">
            <thead >
                <tr>
                    <th>{{__('Matricule ')}} </th>
                    <th>{{__('Nom ')}} </th>
                    <th>{{__('Prenom ')}} </th>
                    <th>{{__('Nom Pere')}} </th>
                    <th>{{__('Nom Mere')}} </th>
                    <th>{{__('Date de naissance')}} </th>
                    <th>{{__('Numero de l Acte de  Naissance')}} </th>
                    <th>{{__()}} </th>
                
                    @php echo $controler->crudheaderm($rub,$srub); @endphp
                </tr>
            </thead>
            <tbody>
            @foreach($eleves as $item)
                <tr >
                    <td>{{$item->Matricule}}</td>
                    <td>{{$item->Nom}}</td>
                    <td>{{$item->Prenom}}</td>
                    <td>{{$item->Nomp}}</td>
                    <td>{{$item->Nomm}}</td>
                    <td>{{$item->datenais}}</td>
                    <td>{{$item->numbactnaiss}}</td>
                    <td>
                       <i class="fas fa-eye"></i>
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

 
<script>
function onCycleChange(idCycle) {
    const niveauSelect = document.querySelector('select[name="niveau"]');
    const classeSelect = document.querySelector('select[name="classe"]');

    niveauSelect.innerHTML = '<option value="">-- Niveau --</option>';
    classeSelect.innerHTML = '<option value="">-- Classe --</option>';

    if (idCycle) {
        fetch(`/niveaux-par-cycle/${idCycle}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(niveau => {
                    const opt = new Option(niveau.libelleniveau, niveau.id);
                    niveauSelect.add(opt);
                });
            });
    }

    document.getElementById('filterForm').submit();
}

function onNiveauChange(idNiveau) {
    const classeSelect = document.querySelector('select[name="classe"]');
    classeSelect.innerHTML = '<option value="">-- Classe --</option>';

    if (idNiveau) {
        fetch(`/classes-par-niveau/${idNiveau}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(classe => {
                    const opt = new Option(classe.libelleclasse, classe.id);
                    classeSelect.add(opt);
                });
            });
    }

    document.getElementById('filterForm').submit();
}

function onClasseChange() {
    document.getElementById('filterForm').submit();
}
</script>

@endsection