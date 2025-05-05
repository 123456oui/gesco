@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier l\'Inscription') }}</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('Eleve.update', $eleve->Matricule) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Fieldset principal à gauche (50%) -->
                            <div class="col-md-6">
                                <fieldset class=" p-4 mb-3 h-auto mt-3">
                                    <legend class="w-auto px-2">Informations générales de l eleve</legend>
                                    <!-- Ajoutez vos champs ici -->
                                     <!-- Affichage + sélection de l'image -->
                                     <div class="mb-3 text-center">
                                        <img id="logo-preview" 
                                            src="{{ $eleve->Photo }}" 
                                            alt="Photo élève" 
                                            class="img-thumbnail" 
                                            style="max-width: 200px; height: 200px; border-radius: 50%; display: block;">
                                            
                                        <input type="hidden" name="photo_actuelle" value="{{ $eleve->Photo }}">
                                        
                                        <input type="file" 
                                            name="photo" 
                                            id="photo-input"
                                            class="form-control mt-2" 
                                            accept="image/*"
                                            onchange="previewLogo(event)">
                                    </div>


                                        <!-- Nom -->
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $eleve->Nom ?? '') }}" required>
                                        </div>

                                        <!-- Prénom -->
                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $eleve->Prenom ?? '') }}" required>
                                        </div>

                                        <!-- Nom du père -->
                                        
                                        <!-- Matricule -->
                                        <div class="mb-3">
                                            <label for="matricule" class="form-label">Matricule</label>
                                            <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule', $eleve->Matricule ?? '') }}" readonly>
                                        </div>

                                        <!-- Numéro d'acte de naissance -->
                                        <div class="mb-3">
                                            <label for="numbactnaiss" class="form-label">Numéro d'acte de naissance</label>
                                            <input type="text" class="form-control" id="numbactnaiss" name="numbactnaiss" value="{{ old('numbactnaiss', $eleve->numbactnaiss ?? '') }}">
                                        </div>

                                        <!-- Date de naissance -->
                                        <div class="mb-3">
                                            <label for="datenais" class="form-label">Date de naissance</label>
                                            <input type="date" class="form-control" id="datenais" name="datenais" value="{{ old('datenais', $eleve->datenais ?? '') }}">
                                        </div>

                                        <!-- Lieu de naissance -->
                                        <div class="mb-3">
                                            <label for="lieunais" class="form-label">Lieu de naissance</label>
                                            <input type="text" class="form-control" id="lieunais" name="lieunais" value="{{ old('lieunais', $eleve->lieunais ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="sante" class="form-label">Etat de sante</label>
                                            <input type="text" class="form-control" id="sante" name="sante" value="{{ old('sante', $eleve->Sante ?? '') }}">
                                        </div>
                                        
                                        <!-- Nom de la mère -->
                                        <div class="mb-3">
                                            <label for="nom_mere" class="form-label">Nom de la mère</label>
                                            <input type="text" class="form-control" id="nom_mere" name="nom_mere" value="{{ old('Nomm', $eleve->Nomm ?? '') }}">
                                        </div>

                                        <!-- Téléphone de la mère -->
                                        <div class="mb-3">
                                            <label for="NumtelM" class="form-label">Téléphone de la mère</label>
                                            <input type="text" class="form-control" id="NumtelM" name="NumtelM" value="{{ old('NumtelM', $eleve->NumtelM ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom_pere" class="form-label">Nom du père</label>
                                            <input type="text" class="form-control" id="nom_pere" name="nom_pere" value="{{ old('Nomp', $eleve->Nomp ?? '') }}">
                                        </div>

                                        <!-- Téléphone du père -->
                                        <div class="mb-3">
                                            <label for="NumtelP" class="form-label">Téléphone du père</label>
                                            <input type="text" class="form-control" id="NumtelP" name="NumtelP" value="{{ old('NumtelP', $eleve->NumtelP ?? '') }}">
                                        </div>

                                        <!-- Établissement d'origine -->
                                        <div class="mb-3">
                                            <label for="etablissement_origine" class="form-label">Établissement d'origine</label>
                                            <input type="text" class="form-control" id="etablissement_origine" name="etablissement_origine" value="{{ old('etablissement_origine', $eleve->etablissement_origine ?? '') }}">
                                        </div>

                                </fieldset>
                            </div>

                            <!-- Deux fieldsets empilés à droite -->
                            <div class="col-md-6 d-flex flex-column">
                                <fieldset class="  mb-2 flex-fill mt-3">
                                    <legend class="w-auto px-2">Cursus scolaire </legend>
                                    <!-- Ajoutez vos champs ici -->
                                     <!-- Cycle -->
                                        <div class="mb-3">
                                            <label for="cycle" class="form-label">Cycle</label>
                                            <select name="cycle" id="cycle" class="form-select" required onchange="showSelection(this)">
                                                <option value="" disabled selected>-- Sélectionner un cycle --</option>
                                                @foreach($cycles as $cycle)
                                                    <option value="{{ $cycle->id }}" {{ old('cycle', $totalInscriptions->idcycle ?? '') == $cycle->id ? 'selected' : '' }}>
                                                        {{ $cycle->libellecycle }}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Niveau -->
                                        <div class="mb-3">
                                            <label for="niveau" class="form-label">Niveau</label>
                                            <select name="niveau" id="niveau" class="form-select" required onchange="showclasse(this)">
                                                <option value=""disabled selected>-- Sélectionner un niveau --</option>
                                                @foreach($niveaux as $cycle)
                                                    <option value="{{ $cycle->id }}" {{ old('niveau', $totalInscriptions->idniveau ?? '') == $cycle->id ? 'selected' : '' }}>
                                                        {{ $cycle->libelleniveau }}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Classe -->
                                        <div class="mb-3">
                                            <label for="classe" class="form-label">Classe</label>
                                            <select name="classe" id="classe" class="form-select" required onchange="max(this)" >
                                                <option value="">-- Sélectionner une classe --</option>
                                                @foreach($classes as $cycle)
                                                    <option value="{{ $cycle->id }}" {{ old('classe', $totalInscriptions->idclasse ?? '') == $cycle->id ? 'selected' : '' }}>
                                                        {{ $cycle->libelleclasse }}
                                                    </option>

                                                @endforeach
                                            </select>
                                            <div id="divrest" style="display: none; justify-content: flex-end; margin: 10px 0;">
    <div style="
        background-color: #f0f4f8;
        border: 1px solid #d1d5db;
        padding: 5px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        font-size: 1rpx;
        color: #111827;
    ">
        <label style="margin-right: 10px; font-weight: bold;">Place restante :</label>
        <label id="rest"></label>
    </div>
</div>
                                        </div class="rrow">
                                        <fieldset class="mb-4 h-25">
                                     <div class="form-group">
                                        <div class="col-md-10">
                                         <label for="documents">{{ __('Extrait de naissance') }}</label>
                                        <div class="dropzone d-flex justify-content-center justify-content-md-left"
                                          id="documentDropzone">
                                        </div>
                                        </div>
                                            @error('documents.*')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                     </div>
                                       
                                    </fieldset>

                                    <fieldset class=" h-25">
                                     <div class="form-group">
                                        <div class="col-md-10">
                                              
                                         <label for="bullettinnotes">{{ __('Bulletin de notes :') }}</label>
                                             <div class="dropzone d-flex justify-content-center justify-content-md-left"
                                              id="bulletinDropzone">
                                              <input type="file" name="images[]" id="hidden-images" style="display: none" multiple>
                                              <input type="hidden" name="removed_images[]" id="removed-images">

                                             </div>
                                        </div>
                                        
                                            @error('documents.*')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                              @enderror
                                     </div>
                                    </fieldset>

                                </fieldset>

                                <fieldset class=" pt-4 flex-fill  mb-3" style="flex: 0 0 20% !important;">
                                    <legend class="w-auto px-2">Intendance</legend>
                                    <!-- Ajoutez vos champs ici -->

                                    <!-- Subvention -->
                                    <div class="mb-4">
                                        <label for="subvention" class="form-label">Subvention</label>
                                        <select name="subvention_id" id="subvention" class="form-select"  onchange="updateCommentaire()" style="height:50px !important;">
                                            <option value="" disabled selected>-- Sélectionner une subvention --</option>
                                            @foreach($pcharges as $cycle)
                                                    <option data-commentaire="{{ $cycle->pmontant}}" value="{{ $cycle->id }}" {{ old('subvention_id', $totalInscriptions->idpcharge ?? '') == $cycle->id ? 'selected' : '' }} >
                                                        {{ $cycle->libellepcharge }}
                                                    </option>

                                                @endforeach
                                        </select>
                                    </div>

                                    <!-- Montant total -->
                                    <div class="mb-4">
                                        <label for="montant" class="form-label">Scolarite</label>
                                        <input type="text" class="form-control" id="montant" name="montant" value="{{$montantScolarite}} FCFA" readonly  style="height:50px;">
                                    </div>

                                    <!-- Net à payer -->
                                    <div class="mb-4">
                                        <label for="subvention_montant" class="form-label">le montant de la subvention</label>
                                        <input type="text" class="form-control" id="subvention_montant" name="subvention_montant" value="{{$montantsub}} FCFA" readonly  style="height:50px;">
                                    </div>

                                    <div class="">
                                        <label for="net_payer" class="form-label">Net à payer</label>
                                        <input type="text" class="form-control" id="net_payer" name="net_payer" value="{{ $totalInscriptions-> montantscolariteE  }} FCFA " readonly  style="height:50px;">
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                        <input type="hidden" name="rub" value="{{ $rub }}">
                        <input type="hidden" name="srub" value="{{ $srub }}">
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('Eleve.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const rub=@json($rub);
const srub=@json($srub);

function matricule(niveau_id) {
    $.ajax({
        url: `/matricule/${niveau_id}`,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Récupérer l'année depuis la session Laravel (exemple : "2023-2024")
            var annee = "{{ session('annee') }}";
            // Extraire les deux derniers chiffres de l'année pour l'utiliser dans le matricule
            var debut = annee.split('-')[0].slice(-2);  // Prend les 2 derniers chiffres de l'année début (ex : 2023 -> 23)
            var fin = annee.split('-')[1].slice(-2);    // Prend les 2 derniers chiffres de l'année fin (ex : 2024 -> 24)

            let codeAnnee = debut + fin;  // Exemple : "2324"
            let matriculeFinal =response.matricule + codeAnnee ;  // Exemple : "2324[matricule élève]"
        },
        error: function (xhr, status, error) {
            console.error('Erreur AJAX :', error);
        }
    });
}
function updateCommentaire() {
        const select = document.getElementById('subvention');
        const selectedOption = select.options[select.selectedIndex];
        const commentaire = selectedOption.getAttribute('data-commentaire');
        document.getElementById('subvention_montant').value = commentaire + " FCFA" || '';
        const mtn={{$montantScolarite}}-commentaire;
        document.getElementById('net_payer').value = mtn + " FCFA" || '';


}
function previewLogo(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const output = document.getElementById('logo-preview');
            output.src = e.target.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

</script>
@endsection
