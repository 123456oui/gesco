@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajouter un Niveau') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('niveau.store') }}">
                            @csrf
                            <div class="form-group row">
                                     <label for="cycle" class="col-md-4 col-form-label text-md-right">{{ __('Cycle') }}<span style="color: red">*</span></label>
                                     <div class="col-md-6">

                                            <select name="cycle" id="cycle" class="formulaire" >
                                                     <option value=""></option>
                                                  @foreach ($cycles as $item)
                                                     <option value="{{ $item->id}}">{{ $item->libellecycle }}</option>
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

                                      </div>
                            </div>

                            

                             <div class="form-group row">
                                <label for="Annee" class="col-md-4 col-form-label text-md-right">{{ __(' Année :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input name="Annee" id="Annee" value="{{old('Annee')}}" class="formulaire" onkeyup="this.value = this.value.toUpperCase();">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('Annee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>



                            <div class="form-group row">
                                <label for="niveau" class="col-md-4 col-form-label text-md-right">{{ __('Niveau :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="niveau" type="text" class="form-control @error('niveau') is-invalid @enderror" name="niveau"
                                    value="{{ old('niveau') }}" required autofocus onkeyup="this.value = this.value.toUpperCase();">
                                    <input type="hidden" name="rub" value={{$rub}} >
                                    <input type="hidden" name="srub" value={{$srub}} >
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
                                <label for="Montantscolarite" class="col-md-4 col-form-label text-md-right">{{ __('Montant de la scolarite :') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input name="Montantscolarite" type="number" id="Montantscolarite" value="{{old('Montantscolarite')}}" class="formulaire">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('Montantscolarite')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('niveau.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection