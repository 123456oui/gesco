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
        border: 1px solid #34733c ;
    }
    .logo-preview img {
        width: 100%;
        height: auto;
        object-fit: cover;
        width: 150px; 
        height: 150px;
    }
   
        .zone-container,
        .zonep-container {
            margin-top: 10px;
            padding: 5px;
            border: 2px dashed #ccc !important;
            border-radius: 5px;
        }

        .dropzone {
            border: 2px dashed #ccc !important;
            border-radius: 5px;
        }

        .removeZone:first {
            display: none;
        }

        .btn-primary-custom {
            background-color: #060 !important;
            border-color: #060 !important;
            color: #fff !important;
        }

        .btn-primary-custom:hover {
            background-color: #045;
            border-color: #034;
        }

        .btn-primary-custom:active {
            background-color: #034;
            border-color: #023;
        }
  





</style>
@endsection

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-12">
       
        
            <div class="card">
                <div class="card-header py-0">{{ __('Ajouter un Elève') }}</div>
               
                    <div class="card-body">
                    <fieldset>
<form class="needs-validation" 
      novalidate 
      id="main-form"
      method="POST" 
      action="{{ route('Eleve.store', ['rub' => $rub, 'srub' => $srub]) }}" 
      enctype="multipart/form-data">  
        @csrf
                                 <div class="row align-items-start">
                                        <div class="col-md-6">
                                                 <label for="Etaorigine"> {{ __('Etablissement d\'Origine') }} <span
                                                    style="color: red">*</span> </label>
                                             <select id="Etaorigine" class="form-control @error('Etaorigine') is-invalid @enderror"
                                                name="Etaorigine" >
                                                <option value=""></option>
                                               
                                            </select>   
                                            
                                            <label for="numactenais"> {{ __('Num Acte de naissance') }} <span
                                                style="color: red">*</span> </label>
                                               <input class="form-control @error('numactenais') is-invalid @enderror"
                                                type="text" name="numactenais" id="numactenais" required
                                                     value="{{ old('numactenais') }}">

                                                     
                                    <label for="cycle">{{ __('Cycle:') }}<span style="color: red">*</span></label>
                     

                                    <select name="cycle" id="cycle" class="formulaire" data-next="niveau" onchange="showSelection(this)">
                                        <option value=""></option>
                                        @foreach ($cycles as $item)
                                            <option value="{{ $item->id }}">{{ $item->libellecycle }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>

                                    @error('cycle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                      
                     <label for="niveau">{{ __('Niveau:') }}<span style="color: red">*</span></label>
                     

                     <select name="niveau" id="niveau" class="formulaire"  onchange="showclasse(this)" >
                        
                     </select>

                     <div class="invalid-feedback">
                         {{__('formulaire.Obligation')}}
                     </div>

                     @error('niveau')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror

                     <label for="classe">{{ __('Classe:') }}<span style="color: red">*</span></label>
                     

                     <select name="classe" id="classe" class="formulaire"  onchange="max(this)">
                        
                     </select>

                     <div class="invalid-feedback">
                         {{__('formulaire.Obligation')}}
                     </div>

                     @error('classe')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
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
                                            






                                 


                                                  <label for="matriculelibelleE"> {{ __('Matricule') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('matriculeE') is-invalid @enderror"
                                                          type="text" name="matriculeE" id="matriculeE" required readonly
                                                          value="{{ old('matricule') }}">

                                                    <label for="nomlibelleE"> {{ __('Nom') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('nomE') is-invalid @enderror"
                                                          type="text" name="nomE" id="nomE" required
                                                          value="{{ old('nomE') }}">

                                                    <label for="prenomlibelleE"> {{ __('Prénom(s)') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required
                                                         value="{{ old('prenomE') }}">

                                                   <label for="datenaislibelleE"> {{ __('Date de naissance') }} <span
                                                        style="color: red">*</span> </label>
                                                         <input class="form-control @error('datenaisE') is-invalid @enderror"
                                                        type="date" name="datenaisE" id="datenaisE" required
                                                        value="{{ old('datenaisE') }}">

                                                   <label for="lieunaislibelleE"> {{ __('Lieu de naissance') }} <span
                                                         style="color: red">*</span> </label>
                                                        <input class="form-control @error('lieunaisE') is-invalid @enderror"
                                                         type="text" name="lieunaisE" id="lieunaisE" required
                                                         value="{{ old('lieunaisE') }}">

                                                    <label for="nomPlibelleE"> {{ __('Nom du père') }} <span
                                                         style="color: red">*</span> </label>
                                                        <input class="form-control @error('nomPE') is-invalid @enderror"
                                                         type="text" name="nomPE" id="nomPE" required
                                                          value="{{ old('nomPE') }}">

                                                    <label for="nomMlibelleE"> {{ __('Nom de la mère') }} <span
                                                         style="color: red">*</span> </label>
                                                         <input class="form-control @error('nomME') is-invalid @enderror"
                                                          type="text" name="nomME" id="nomME" required
                                                          value="{{ old('nomME') }}">
                                                          
                                                    <label for="numtelPlibelleE"> {{ __('Numéro de téléphone du père') }} </label>
                                                         <input class="form-control @error('numtelPE') is-invalid @enderror"
                                                         type="text" name="numtelPE" id="numtelPE" required
                                                          value="{{ old('numtelPE') }}"> 
                                                   <label for="numtelMlibelleE"> {{ __('Numéro de téléphone de la mère') }} </label>
                                                          <input class="form-control @error('numtelME') is-invalid @enderror"
                                                          type="text" name="numtelME" id="numtelME" required
                                                         value="{{ old('numtelME') }}">                     

                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="mt-3">
                                              <legend>{{ __('Photo') }}</legend>
                                              <div class="form-group row">
                                                   <label for="logo" class="col-md-4 col-form-label text-md-right"></label>
                                                   <div class="col-md-6 d-flex align-items-center">
                                                         <div class="logo-preview">
                                                          <img id="logo-preview" src="#" alt="Logo" class="img-thumbnail" style="border-radius: 50%; display: none;"/>
                                                         </div>
                                                    </div>
                                             </div>
                                             <div class="form-group row">
                                                        <div class="col-md-12">
                                                             <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" onchange="previewLogo(event)">
                                                          <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                          </div>
                                                            @error('logo')
                                                             <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                              </span>
                                                         @enderror
                                                     </div>
                                              </div>   

                                            </fieldset>

                                            <div class="form-group">
                                               <div class="col-md-12">
                                                  <label for="sante"> Santé <span style="color: red">*</span> </label>
                                                   <textarea class="form-control @error('sante') is-invalid @enderror" type="text" name="sante" id="sante"
                                                     required>{{ old('sante') }}</textarea>
                                                </div>
                                                 <div class="invalid-feedback">
                                                     {{ __('formulaire.Obligation') }}
                                                  </div>
                                                 @error('sante')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                   </span>
                                                 @enderror
                                             </div>

    <fieldset class='mb-4'>
    <legend>{{ __('Subvention') }}</legend>
    <div class="form-group row">
        <div class="col-md-12 d-flex align-items-center">
            <label class="mr-2">{{ __('Bénéficie d’une subvention ?') }}</label>
            <input type="checkbox" id="subventionSwitch" onchange="toggleSubvention()" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="typeSubvention">{{ __('Type de subvention') }}</label>
            <select class="form-control" name="typeSubvention" id="typeSubvention" disabled onchange="updateCommentaire()">
                <option value="">{{ __('Choisir...') }}</option>
                @foreach($subventions as $subvention)
                    <option value="{{ $subvention->id }}" data-commentaire="{{ $subvention->pmontant}}">
                        {{ $subvention->libellepcharge }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="commentaireSubvention">{{ __('Montant de la prise en charge ') }}</label>
            <input type="text" class="form-control" name="commentaireSubvention" id="commentaireSubvention" disabled>
        </div>
    </div>
</fieldset>



                                    <fieldset>
                                     <div class="form-group">
                                        <div class="col-md-12">
                                         <label for="documents">{{ __('Extrait de naissance') }}</label>
                                        <div class="dropzone d-flex justify-content-center justify-content-md-left"
                                          id="my-dropzone" >
                                          <input type="file" name="acte_naissance" id="acte_naissance" class="d-none" />
                                        </div>
                                        </div>
                                            @error('documents.*')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                     </div>
                                    </fieldset>

                                    <fieldset>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                              
                                         <label for="bullettinnotes">{{ __('Bulletin de notes :') }}</label>
                                                 <div class="dropzone d-flex justify-content-center justify-content-md-left" id="bulletin-dropzone" >
                                                 <input type="file" name="photo_identite" id="photo_identite" class="d-none" />
                                             </div>
                                        </div>
                                        
                                            @error('documents.*')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                              @enderror
                                     </div>
                                    </fieldset>
                                  

                                    


                                 </div>








                                 <input type="hidden" name="rub" value="{{ $rub }}">
                                 <input type="hidden" name="srub" value="{{ $srub }}">

                    </fieldset>
                                <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
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
</div>
@if(session('js_alert'))
    <script>
        alert("{{ session('js_alert') }}");
    </script>
@endif

@push('scripts')
<script>
const rub=@json($rub);
const srub=@json($srub);

function previewLogo(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
}
    function toggleSubvention() {
    const isChecked = document.getElementById('subventionSwitch').checked;
    document.getElementById('typeSubvention').disabled = !isChecked;
    document.getElementById('commentaireSubvention').disabled = !isChecked;

    if (!isChecked) {
        document.getElementById('typeSubvention').value = '';
        document.getElementById('commentaireSubvention').value = '';
    }
}

    function updateCommentaire() {
        const select = document.getElementById('typeSubvention');
        const selectedOption = select.options[select.selectedIndex];
        const commentaire = selectedOption.getAttribute('data-commentaire');
        document.getElementById('commentaireSubvention').value = commentaire + " FCFA" || '';
}


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

            $('#matriculeE').val(matriculeFinal);  // Assigner le matricule final au champ
            // Vous pouvez utiliser ces valeurs comme vous le souhaitez ici
        },
        error: function (xhr, status, error) {
            console.error('Erreur AJAX :', error);
        }
    });
}

Dropzone.autoDiscover = false; // évite l'auto-instanciation

// Dropzone pour l'acte de naissance
const acteDropzone = new Dropzone("#my-dropzone", {
    url: "#",
    autoProcessQueue: false,
    maxFiles: 1,
    addRemoveLinks: true,
    acceptedFiles: ".pdf",
    dictDefaultMessage: "Déposez l'acte de naissance ici",
    init: function () {
        this.on("addedfile", function (file) {
            let input = document.getElementById("acte_naissance");
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
        });
    }
});

// Dropzone pour la photo d'identité
const photoDropzone = new Dropzone("#bulletin-dropzone", {
    url: "#",
    autoProcessQueue: false,
    maxFiles: 1,
    addRemoveLinks: true,
    acceptedFiles: ".pdf",
    dictDefaultMessage: "Déposez les billetins ici",
    init: function () {
        this.on("addedfile", function (file) {
            let input = document.getElementById("photo_identite");
            let dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
        });
    }
});

// Interception du formulaire

</script>


@endpush

@endsection