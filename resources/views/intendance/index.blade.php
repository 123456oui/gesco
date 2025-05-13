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
            margin-top: 5px;
            padding: 2px;
            border: 2px dashed #ccc !important;
            border-radius: 10px;
        }

        .dropzone {
            border: 1px dashed #ccc !important;
            border-radius: 10px;
        }

        .removeZone:first {
            display: none;
        }

</style>
@endsection

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-10">
       
        
            <div class="card">
                <div class="card-header py-0">{{ __('REGLEMENT SCOLARITE') }}</div>
               
                    <div class="card-body">

                    <fieldset class="mb-4">
                    <form class="needs-validation" novalidate method="POST" action="{{ route('intendance.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-start">
                             <div class="col-md-5">
                                       <label for="cycle">{{ __('Cycle:') }}<span style="color: red">*</span></label>
                                          <select name="cycle" id="cycle" class="formulaire" onchange="onCycleChange(this.value)">
                                               <option value=""></option>
                                                   @foreach ($cycles as $item)
                                                <option value="{{ $item->id }}">{{ $item->libellecycle }}</option>
                                                  @endforeach
                                            </select>

                                                <div class="invalid-feedback">
                                                  {{__('formulaire.Obligation')}}
                                                </div>
                                                  @error('classe')
                                                   <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                   </span>
                                                   @enderror
                                        
                                         <label for="niveau">{{ __('Niveaux:') }}<span style="color: red">*</span></label>
                                          <select name="niveau" id="niveau" class="formulaire" onchange="onNiveauChange(this.value)" >
                                               <option value=""></option>
                                                   @foreach ($niveaux as $item)
                                                <option value="{{ $item->id }}">{{ $item->libelleniveau }}</option>
                                                  @endforeach
                                         </select>
                                         <label for="classe">{{ __('Classes:') }}<span style="color: red">*</span></label>
                                          <select name="classe" id="classe" class="formulaire" onchange="onClasseChange(this.value)" >
                                               <option value=""></option>
                                                   @foreach ($classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->libelleclasse }}</option>
                                                  @endforeach
                                         </select>
                                         <label for="matricule">{{ __('Matricule:') }}<span style="color: red">*</span></label>
                                          <select name="matricule" id="matricule" class="formulaire" onchange="onMatriculeChange(this.value)" >
                                               <option value=""></option>
                                                   @foreach ($inscriptions as $item)
                                                <option value="{{ $item->Matricule }}">{{ $item->Matricule }}</option>
                                                  @endforeach
                                         </select>
                                        

                                         <div class="invalid-feedback">
                                                  {{__('formulaire.Obligation')}}
                                          </div>
                                            @error('classe')
                                             <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            
                                            <label for="nomlibelleE"> {{ __('Nom') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('nomE') is-invalid @enderror"
                                                          type="text" name="matriculeE" id="matriculeE" required readonly
                                                          value="{{ old('matriculeE') }}">

                                             <label for="prenomlibelleE"> {{ __('Prénom(s)') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required readonly
                                                         value="{{ old('prenomE') }}">
                             </div>
                             <div class="col-md-6">
                                         <div class="form-group row">


                                            <label for="acte"> {{ __('Numéro d acte de naissance :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('acte') is-invalid @enderror"
                                                         type="text" name="acte" id="acte" required readonly
                                                         value="{{ old('acte') }}">
                                            
                                            <label for="cumul"> {{ __('Cumul des Versement :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('cumul') is-invalid @enderror"
                                                         type="text" name="cumul" id="cumul" required readonly
                                                         value="{{ old('cumul') }}">
                                            <label for="reste"> {{ __('Reste A verser :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('reste') is-invalid @enderror"
                                                         type="text" name="reste" id="reste" required readonly
                                                         value="{{ old('reste') }}">

                                            <fieldset class="col-md-12 mb-2 mt-2">
                                                            <legend class="text-primary">Versement</legend>

                                                            <div class="form-group mb-3">
                                                                <label for="banque">{{ __('Banques :') }}<span style="color: red">*</span></label>
                                                                <select name="banque" id="banque" class="form-control">
                                                                    <option value=""></option>
                                                                    @foreach ($banques as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->libellebanque }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="versement">{{ __('Versement :') }}<span style="color: red">*</span></label>
                                                                <input class="form-control @error('versement') is-invalid @enderror"
                                                                    type="number" name="versement" id="versement" required
                                                                    value="{{ old('versement') }}">
                                                                @error('versement')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="tiketBanque">{{ __('Tiket Banque :') }}</label>
                                                                <div class="dropzone d-flex justify-content-center align-items-center" id="documentDropzone">
                                                                <input type="file" name="banques" id="banques" class="d-none" />
                                                                </div>
                                                                @error('documents.*')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </fieldset>
                                        </div>
                             </div>
                     </div>
                    </fieldset>

                    <div class="form-group row mb-0">
                                         <div class="col-md-6 offset-md-4">
                                         <input type="hidden" name="rub" value="{{ $rub }}">
                                         <input type="hidden" name="srub" value="{{ $srub }}">
                                                 <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                            </div>
                     </div>
                 </form>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>



@push('scripts')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 20000
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 20000
    });
</script>
@endif

<script>
    function previewLogo(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script>
    const allNiveaux = @json($niveaux);
    const allInscriptions = @json($inscriptions);
    const allClasses = @json($classes); 

    function ranger(selectId, data, valueField, textField) {
        const select = document.getElementById(selectId);
        select.innerHTML = '<option value="selected disable">selectionner</option>'; // Réinitialiser
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueField];
            option.text = item[textField];
            select.appendChild(option);
        });
    }
    function onCycleChange(cycleId) {
        // 🔁 Filtrer les niveaux
        const filteredNiveaux = allNiveaux.filter(niveau => niveau.idcycle == cycleId);
        ranger('niveau', filteredNiveaux, 'id', 'libelleniveau');

        // 🔁 Filtrer les inscriptions
        const filteredInscriptions = allInscriptions.filter(inscription => inscription.idcycle == cycleId);
        ranger('matricule', filteredInscriptions, 'Matricule', 'Matricule');
    }
    function onNiveauChange(idNiveau) {
        // 🔁 Filtrer les classes selon le niveau
        const filteredClasses = allClasses.filter(classe => classe.idniveau == idNiveau);
        ranger('classe', filteredClasses, 'id', 'libelleclasse');

        // 🔁 Filtrer les inscriptions selon le niveau
        const filteredInscriptions = allInscriptions.filter(inscription => inscription.idniveau == idNiveau);
        ranger('matricule', filteredInscriptions, 'Matricule', 'Matricule');
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
                    document.getElementById('acte').value = data.eleve.numbactnaiss || '';
                    document.getElementById('cumul').value = data.total_regle ;
                    document.getElementById('reste').value = data.reste ;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    }
</script>
<script>
    const photoDropzone = new Dropzone("#documentDropzone", {
        url: "#",
        autoProcessQueue: false,
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: ".pdf",
        dictDefaultMessage: "Déposez le ticket de banque ici",
        init: function () {
            this.on("addedfile", function (file) {
                // Crée une prévisualisation pour les PDF
                // Ajoute le fichier au champ caché
                let hiddenInput = document.getElementById("banques");
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                hiddenInput.files = dataTransfer.files;
            });
        }
    });
</script>

@endpush

@endsection