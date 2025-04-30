@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier une Prise en Charge') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('pcharge.update',$pcharge->id)}}">
                            @csrf                            
                            @method('PUT')
                            <div class="form-group row">
                                <label for="structure" class="col-md-4 col-form-label text-md-right">{{ __('Structure :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="structure" type="text" class="form-control @error('structure') is-invalid @enderror" name="structure"
                                    value="{{$pcharge->libellepcharge}}" required autofocus onkeyup="this.value = this.value.toUpperCase();">
                                    <input type="hidden" name="rub" value={{$rub}} >
                                    <input type="hidden" name="srub" value={{$srub}} >
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('structure')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pmontant" class="col-md-4 col-form-label text-md-right">{{ __('Montant :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input name="pmontant" type="number" id="pmontant" value="{{$pcharge->pmontant}}" class="formulaire">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('pmontant')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('pcharge.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection