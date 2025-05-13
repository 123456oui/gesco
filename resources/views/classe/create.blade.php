@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajouter Classe') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('classe.store') }}">
                            @csrf

                            <div class="form-group row">
                                     <label for="niveau" class="col-md-4 col-form-label text-md-right">{{ __('Niveau') }}<span style="color: red">*</span></label>
                                     <div class="col-md-6">

                                            <select name="niveau" id="niveau" class="formulaire" >
                                                     <option value=""></option>
                                                  @foreach ($niveaux as $item)
                                                     <option value="{{ $item->id }}">{{ $item->libelleniveau }}</option>
                                                   @endforeach
                                             </select>

                                              <div class="invalid-feedback">
                                                 {{__('formulaire.Obligation')}}
                                             </div>
                                              @error('niveau')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                             @enderror

                                      </div>
                            </div>

                         




                            <div class="form-group row">
                                <label for="classe" class="col-md-4 col-form-label text-md-right">{{ __('Classe') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="classe" type="text" class="form-control @error('cycle') is-invalid @enderror" name="classe"
                                    value="{{ old('classe') }}" required autofocus onkeyup="this.value = this.value.toUpperCase();">
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
                                <label for="Max" class="col-md-4 col-form-label text-md-right">{{ __(' Max :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input name="Max" id="Max" value="{{old('Max')}}" class="formulaire" onkeyup="this.value = this.value.toUpperCase();">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('Max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('classe.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection