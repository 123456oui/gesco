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

            <div class="col-md-4">
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
        </form>
        </div>
    </div>
    <form id="imprimerForm" method="POST" action="{{ route('state.impression.analyse') }}">
        @csrf
        <div class="main-card card">
            <div class="card-header py-0 d-flex align-items-center">
                <h4 class="mb-0 flex-grow-1">{{ __('Liste des eleves') }}</h4>
                <button type="submit" id="imprimerBtn" class="btn btn-success" disabled>
                    <i class="fas fa-print me-2"></i> Imprimer
                </button>
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
                    <th>
                    <input type="checkbox" id="checkAll">
                    </th>
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
                        <input type="checkbox" name="eleves[]" value="{{ $item->Matricule }}">
                    </td>
                    @php
                        $route = 'route';
                        echo $controler->crudbodyms($rub,$srub,$route,'state.edit',$item->Matricule);
                    @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>
<br>
    {{-- <a href="/exportExcelCause" >
        <button class="btn btn-primary btnEnregistrer">{{ __('liste.exporter') }}</button>
    </a> --}}
</div>
@if(session('a_jour') || session('non_a_jour'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    let html = '';
    @if(session('a_jour'))
        html += `
            <div style="text-align:left; margin-bottom:20px;">
                <div style="font-size:18px; color:#198754; font-weight:bold; margin-bottom:8px;">
                    ✅ Élèves à jour
                </div>
                <ul style="list-style: none; padding-left:0;">
                    @foreach(session('a_jour') as $eleve)
                        <li style="margin-bottom:5px; padding:6px 12px; background:#e9fbe7; border-radius:8px;">
                            <span style="font-weight:bold;">{{ $eleve->Nom }} {{ $eleve->Prenom }}</span>
                            <span style="color:#888;"> Matricule :  ({{ $eleve->Matricule }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        `;
    @endif
    @if(session('non_a_jour'))
        html += `
            <div style="text-align:left;">
                <div style="font-size:18px; color:#dc3545; font-weight:bold; margin-bottom:8px;">
                    ❌ Élèves non à jour
                </div>
                <ul style="list-style: none; padding-left:0;">
                    @foreach(session('non_a_jour') as $eleve)
                        <li style="margin-bottom:5px; padding:6px 12px; background:#fdeaea; border-radius:8px;">
                            <span style="font-weight:bold;">{{ $eleve->Nom }} {{ $eleve->Prenom }}</span>
                            <span style="color:#888;"> Matricule : ({{ $eleve->Matricule }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        `;
    @endif

    Swal.fire({
        icon: 'info',
        title: '<span style="font-size:22px;">Résultat de l\'analyse</span>',
        html: html,
        showConfirmButton: true,
        confirmButtonText: '<i class="fas fa-print"></i> Imprimer les à jour',
        width: 650,
        customClass: {
            popup: 'shadow-lg rounded-4'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let urls = [
                @foreach(session('a_jour') as $eleve)
                    "{{ route('state.edit', ['state' => $eleve->Matricule, 'rub' => $rub, 'srub' => $srub]) }}",
                @endforeach
            ];

            function openAndPrintSequentially(urls, index = 0) {
                if (index >= urls.length) {
                    window.location.href = "{{ url('state/' . $rub . '/' . $srub) }}";
                    return;
                }

                let win = window.open(urls[index], '_blank');

                let timer = setInterval(function () {
                    if (win && win.document && win.document.readyState === 'complete') {
                        clearInterval(timer);

                        // Extraire le contenu du #carte-section
                        let carte = win.document.getElementById('carte-section');
                        if (!carte) {
                            // Si carte-section introuvable, imprimer toute la page
                            win.print();
                            win.close();
                            openAndPrintSequentially(urls, index + 1);
                            return;
                        }

                        let content = carte.outerHTML;

                        // Réécriture du contenu de la page avec uniquement le div
                        win.document.body.innerHTML = `
                            <html>
                                <head> 
                                    <style>
                                        @media print {
                                            body {
                                            margin-top:100px;
                                                background: white;
                                            }
                                        }
                                    </style>
                                </head>
                                <body>${content}</body>
                            </html>
                        `;
                        win.document.close();

                        // Lancer impression et continuer
                        setTimeout(function () {
                            win.focus();
                            win.print();
                            win.close();
                            openAndPrintSequentially(urls, index + 1);
                        }, 1000);
                    }
                }, 700);
            }

            if (urls.length > 0) {
                openAndPrintSequentially(urls);
            }
        }
    });
});
</script>
@endif

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="eleves[]"]');
    const imprimerBtn = document.getElementById('imprimerBtn');

    function toggleButton() {
        imprimerBtn.disabled = !Array.from(checkboxes).some(cb => cb.checked);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', toggleButton));
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="eleves[]"]');
    const imprimerBtn = document.getElementById('imprimerBtn');
    const checkAll = document.getElementById('checkAll');

    function toggleButton() {
        imprimerBtn.disabled = !Array.from(checkboxes).some(cb => cb.checked);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', toggleButton));

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = checkAll.checked);
            toggleButton();
        });

        // Si on décoche une case, décocher "tout cocher"
        checkboxes.forEach(cb => cb.addEventListener('change', function() {
            if (!cb.checked) {
                checkAll.checked = false;
            } else if (Array.from(checkboxes).every(cb => cb.checked)) {
                checkAll.checked = true;
            }
        }));
    }
});
</script>
@endsection