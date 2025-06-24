@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajouter un Avoir') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('paramavoir.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="avoir" class="col-md-4 col-form-label text-md-right">{{ __('Avoir') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="avoir" type="text" class="form-control @error('avoir') is-invalid @enderror" name="avoir"
                                    value="{{ old('avoir') }}" required autofocus onkeyup="this.value = this.value.toUpperCase();">
                                    <input type="hidden" name="rub" value={{$rub}} >
                                    <input type="hidden" name="srub" value={{$srub}} >
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('classe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                               <div class="form-group row">
                                <label for="Montantavoir" class="col-md-4 col-form-label text-md-right">{{ __(' Montant :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input name="Montantavoir"  type="number" id="Montantavoir" value="{{old('Montantavoir')}}" class="formulaire" onkeyup="this.value = this.value.toUpperCase();">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('Montantavoir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('paramavoir.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection