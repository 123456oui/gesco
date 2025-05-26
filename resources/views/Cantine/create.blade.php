
@extends('layouts.template')

@section('styles')
<style>
    .logo-preview {
        width: 150px;
        height: 150px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #34733c;
    }
    .logo-preview img {
        width: 100%;
        height: auto;
        object-fit: cover;
        width: 150px;
        height: 150px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header py-0">{{ __('REGLEMENT CANTINE') }}</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('cantine.store') }}">
                        @csrf
                        <fieldset class="mb-4">
                            <div class="row align-items-start">
                                <!-- Colonne gauche -->
                                <div class="col-md-5">
                                    <label for="classe">{{ __('Classe:') }}<span style="color: red">*</span></label>
                                    <select name="classe" id="classe" class="formulaire" onchange="onClasseChange(this.value)">
                                        <option value="" selected disabled>Sélectionner la classe de l'élève</option>
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->libelleclasse }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('formulaire.Obligation') }}</div>
                                    @error('classe')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <label for="matricule">{{ __('Matricule:') }}<span style="color: red">*</span></label>
                                    <select name="matricule" id="matricule" class="formulaire" onchange="onMatriculeChange(this.value)" required>
                                        <option value="" selected disabled>Sélectionner le Matricule de l'élève</option>
                                        @foreach ($inscriptions as $item)
                                            <option value="{{ $item->Matricule }}">{{ $item->Matricule }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('formulaire.Obligation') }}</div>
                                    @error('matricule')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <label for="nomlibelleE">{{ __('Nom') }} <span style="color: red">*</span></label>
                                    <input class="form-control @error('nomE') is-invalid @enderror"
                                           type="text" name="matriculeE" id="matriculeE" required
                                           value="{{ old('matriculeE') }}" readonly>

                                    <label for="prenomlibelleE">{{ __('Prénom(s)') }} <span style="color: red">*</span></label>
                                    <input class="form-control @error('prenomE') is-invalid @enderror"
                                           type="text" name="prenomE" id="prenomE" required
                                           value="{{ old('prenomE') }}" readonly >
                                </div>
                                <!-- Colonne droite -->
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="moiscant">{{ __('Mois:') }}<span style="color: red">*</span></label>
                                        <select id="moiscant" class="form-control @error('moiscant') is-invalid @enderror"
                                                name="moiscant[]" multiple required onchange="mettreAJourVersement()">
                                            <option value="" disabled >Sélectionner le(s) mois</option>
                                            @foreach ($mois as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom_mois }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ __('formulaire.Obligation') }}</div>
                                        @error('moiscant')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                        <label for="Versement">{{ __('Versement :') }} <span style="color: red"></span></label>
                                        <input class="form-control @error('versement') is-invalid @enderror"
                                               type="text" name="versement" id="versement" required
                                               value="{{ old('versement') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" id="valider" value="{{ __('Enregistrer') }}" class="btn btn-primary btnEnregistrer"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('mesmois'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    let html = '';
    let mesmos = @json(session('mesmois'));
    let matricule=@json(session('matricule'));
    let rub = @json(session('rub'));
    let srub = @json(session('srub'));
    let montant = @json(session('cantinesome'));
     let total= mesmos.length * montant;
    const moisEncoded = encodeURIComponent(JSON.stringify(mesmos));
    @if(session('mesmois'))
        html += `
            <div style="text-align:left; margin-bottom:20px;">
                <div style="font-size:18px; color:#198754; font-weight:bold; margin-bottom:8px;">
                    ✅ les mois à enregistrer
                </div>
                <ul style="list-style: none; padding-left:0;">
                    @foreach(session('mesmois') as $eleve)
                        <li style="margin-bottom:5px; padding:6px 12px; background:#e9fbe7; border-radius:8px;">
                            <span style="font-weight:bold;">{{ $eleve}}</span>
                        </li>
                    @endforeach
                </ul>
                <hr style="border-top: 1px solid #198754; margin: 20px 0;">
                <div style="font-size:18px; color:#198754; font-weight:bold; margin-bottom:8px;">
                    ✅ le montant reel
                    </div>
                    <ul style="list-style: none; padding-left:0;">
                        <li style="margin-bottom:5px; padding:6px 12px; background:#e9fbe7; border-radius:8px;">
                            <span style="font-weight:bold;"> ${total} FCFA</span>
                        </li>
                </ul>
            </div>
        `;
    @endif
    Swal.fire({
        icon: 'info',
        title: '<span style="font-size:22px;">Résultat de l\'analyse</span>',
        html: html,
        showConfirmButton: true,
        confirmButtonText: '<i class="fas fa-print"></i> Confirmer et imprimer',
        width: 650,
        customClass: {
            popup: 'shadow-lg rounded-4'
        },
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: true,
    }).then((result) => {
        if (result.isConfirmed) {
             const url = `{{ url('cantine/recu') }}/${matricule}/${rub}/${srub}?mois=${moisEncoded}`;
            window.location.href = url;
        } else if (result.isDismissed) {
            console.log('Utilisateur a fermé la popup sans confirmer');
            // Place ici la logique à exécuter si fermeture sans confirmation
        }
    });
});
</script>
@endif

@endsection

@push('scripts')
<script>
const allInscriptions = @json($inscriptions);

function previewLogo(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('logo-preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function ranger(selectId, data, valueField, textField) {
    const select = document.getElementById(selectId);
    select.innerHTML = '<option value="" selected disabled>Sélectionner</option>'; // Réinitialiser
    data.forEach(item => {
        const option = document.createElement('option');
        option.value = item[valueField];
        option.text = item[textField];
        select.appendChild(option);
    });
}

function onClasseChange(idClasse) {
    const filteredInscriptions = allInscriptions.filter(inscription => inscription.idclasse == idClasse);
    ranger('matricule', filteredInscriptions, 'Matricule', 'Matricule');
}

function onMatriculeChange(matricule) {
    if (!matricule) return;
    fetch(`/get-eleve/${matricule}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                document.getElementById('matriculeE').value = data.eleve.Nom || '';
                document.getElementById('prenomE').value = data.eleve.Prenom || '';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
}
</script>
<script>
    function mettreAJourVersement() {
        const select = document.getElementById('moiscant');
        const selected = Array.from(select.selectedOptions).map(option => option.value);

        if (selected.length === 0) {
            document.getElementById('versement').value = '';
            return;
        }
        const somme = "{{ session('cantinesome') }}";
        document.getElementById('versement').value = selected.length * somme + 'FCFA';
    }
</script>

@endpush