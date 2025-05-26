
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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">{{ __('REINSCRIPTION') }}</div>
                <div class="card-body">
                    <fieldset class="mb-4 col-md-12">
                        <legend class="text-primary">{{ __('Informations sur l élève') }}</legend>
                        <div class="form-group">
                            <form class="needs-validation" novalidate method="POST" action="{{  route('resinscipte.store', ['rub' => $rub, 'srub' => $srub]) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="rub" value="{{ $rub }}">
                                <input type="hidden" name="srub" value="{{ $srub }}">
                                <div class="row align-items-start">
                                    <div class="col-md-5">
                                        <label for="Matricule">{{ __('Matricule:') }}<span style="color: red">*</span></label>
                                        <select name="Matricule" id="Matricule" class="formulaire" onchange="afficherInfosEleve()" required> >
                                            <option value="" disable selected> selectionner l eleve a reinscrire</option>
                                            @foreach ($eleves as $item)
                                                <option value="{{ $item->Matricule }}">{{ $item->Matricule }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                        @error('Matricule')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <label for="classe">{{ __('Classe:') }}<span style="color: red">*</span></label>
                                        <select name="classe" id="classe" class="formulaire"  required  onchange="max(this)" >
                                            <option value="" disable selected > selectionner la classe de reinscription</option>
                                            @foreach ($classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->libelleclasse }}</option>
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
                                    </div>
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
                                </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-4 col-md-12 " style="display: none;" id="infosEleve">   
                        <legend class="text-primary">{{ __('confirmer l élève') }}</legend>
                            <div class=" row justify-content-center align-items-center" style="height:100%;">
                                <!-- Partie gauche -->
                                <div class="col-md-6">
                                    <!-- Contenu de la première partie -->
                                    <div class="form-group">
                                       <img id="img" src="#" alt="Photo élève" style="width:300px; height:300px; object-fit:cover; border-radius:50%; border:2px solid #085a91; display:block; margin:auto;">
                                    </div>
                                </div>

                                <!-- Partie droite -->
                                 <div class="col-md-6  justify-content-center align-items-center" style="height:100%;">
                                    <!-- Nouvelle ligne pour subdiviser en deux colonnes -->
                                    <div class="row">
                                        <!-- Sous-partie droite gauche -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p style="font-weight:bold;"  >Nom</p>
                                                <p style="font-weight:bold;" >Prenom</p>
                                                <p style="font-weight:bold;" >Date de Naissance</p>
                                                <p style="font-weight:bold;"  >Lieu de Naissance</p>
                                                <p style="font-weight:bold;" >Numero Acte de Naissance</p>
                                            </div>
                                        </div>

                                        <!-- Sous-partie droite droite -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p style="font-weight:bold;" id="nom" > <span class="mr-2"> : </span> Nom</p>
                                                <p style="font-weight:bold;" id="prenom" > <span class="mr-2"> : </span>Prenom</p>
                                                <p style="font-weight:bold;" id="dateNaissance" > <span class="mr-2"> : </span>Date de Naissance</p>
                                                <p style="font-weight:bold;" id="lieuNaissance" > <span class="mr-2"> : </span>Lieu de Naissance</p>
                                                <p style="font-weight:bold;" id="numeroactenaisse" > <span class="mr-2"> : </span>Numero Acte de Naissance</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <input type="hidden" name="rub" value="{{ $rub }}">
                            <input type="hidden" name="srub" value="{{ $srub }}">
                            <input type="submit" id="valider" value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Liste des élèves encodée depuis PHP vers JavaScript
    const eleves = @json($eleves);

    function afficherInfosEleve() {
        const matricule = document.getElementById("Matricule").value;
        const fild = document.getElementById("infosEleve");

        const eleve = eleves.find(e => e.Matricule === matricule);

        if (eleve) {
            document.getElementById('nom').innerHTML = '<span class="mr-2"> : </span>' + eleve.Nom;
            document.getElementById('prenom').innerHTML = '<span class="mr-2"> : </span>' + eleve.Prenom;
            document.getElementById('dateNaissance').innerHTML = '<span class="mr-2"> : </span>' + eleve.datenais;
            document.getElementById('lieuNaissance').innerHTML = '<span class="mr-2"> : </span>' + eleve.lieunais;
            document.getElementById('numeroactenaisse').innerHTML = '<span class="mr-2"> : </span>' + eleve.numbactnaiss;

            if (eleve.Photo) {
                document.getElementById('img').src = eleve.Photo;
            } else {
                document.getElementById('img').src = '#';
            }
        } else {
            // Réinitialiser si matricule non trouvé
            document.getElementById('nom').innerHTML = '';
            document.getElementById('prenom').innerHTML = '';
            document.getElementById('dateNaissance').innerHTML = '';
            document.getElementById('lieuNaissance').innerHTML = '';
            document.getElementById('numeroactenaisse').innerHTML = '';
            document.getElementById('img').src = '#';
        }
        fild.style.display = 'block';
    }
</script>

@if(session('swal_message'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'warning',
        title: 'Retard de Scolarite',
        html: `{!! session('swal_message') !!}`,
        width: 600,
        confirmButtonText: 'OK',
        customClass: {
            popup: 'shadow-lg rounded-4'
        }
    });
});
</script>
@endif
@if(session('swal'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'warning',
        title: 'Analyse',
        html: `{!! session('swal') !!}`,
        width: 600,
        confirmButtonText: 'OK',
        customClass: {
            popup: 'shadow-lg rounded-4'
        }
    });
});
</script>
@endif

@if(session('successs'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Enregistre',
        html: `{!! session('successs') !!}`,
        width: 600,
        confirmButtonText: 'OK',
        customClass: {
            popup: 'shadow-lg rounded-4'
        }
    });
});
</script>
@endif

@endsection
