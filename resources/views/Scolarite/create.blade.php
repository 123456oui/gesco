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
</style>
@endsection

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-9">
       
        
            <div class="card">
                <div class="card-header py-0">{{ __('REGLEMENT SCOLARITE') }}</div>
               
                    <div class="card-body">

                    <fieldset>
                    <form class="needs-validation" novalidate method="POST" action="{{ route('scolarite.store') }}">
                    @csrf
                    <div class="row align-items-start">
                             <div class="col-md-5">
                                       <label for="classe">{{ __('Classe:') }}<span style="color: red">*</span></label>
                                          <select name="classe" id="classe" class="formulaire" >
                                               <option value=""></option>
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
                                        
                                         <label for="matricule">{{ __('matricule:') }}<span style="color: red">*</span></label>
                                          <select name="matricule" id="matricule" class="formulaire" >
                                               <option value=""></option>
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
                                            
                                            <label for="nomlibelleE"> {{ __('Nom') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('nomE') is-invalid @enderror"
                                                          type="text" name="matriculeE" id="matriculeE" required
                                                          value="{{ old('matriculeE') }}">

                                             <label for="prenomlibelleE"> {{ __('Prénom(s)') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required
                                                         value="{{ old('prenomE') }}">


                             </div>
                             <div class="col-md-5">
                                         <div class="form-group row">


                                            <label for="prenomlibelleE"> {{ __('Numéro Pièce :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required
                                                         value="{{ old('prenomE') }}">
                                            
                                            <label for="prenomlibelleE"> {{ __('Cumul des Versement :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required
                                                         value="{{ old('prenomE') }}">




                                              <label for="Versement"> {{ __('Versement :') }} <span
                                                    style="color: red">*</span> </label>
                                                         <input class="form-control @error('prenomE') is-invalid @enderror"
                                                         type="text" name="prenomE" id="prenomE" required
                                                         value="{{ old('prenomE') }}">
                                                         
                                                         <fieldset>
                                     
                                        
                                         <label for="tiketBanque">{{ __('Tiket Banque :') }}</label>
                                             <div class="dropzone d-flex justify-content-center justify-content-md-left"
                                              id="documentDropzone">
                                             </div>
                                     
                                            @error('documents.*')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                              @enderror
                                  
                                    </fieldset>
                                  




                                        </div>

                                 
                             </div>




                

                     </div>







                    </fieldset>

                    <div class="form-group row mb-0">
                                         <div class="col-md-6 offset-md-4">
                                                 <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                                <a href="{{route('Eleve.index')}}/{{$rub}}/{{$srub}}">
				                                <input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/>
				                                </a>
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
@endpush

@endsection