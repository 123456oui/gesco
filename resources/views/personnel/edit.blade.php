@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier un Personnel') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('personnel.update',$personnel->id) }}">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <legend>Informations Generales</legend>
                                            {{-- Matricule --}}
                                            <div class="form-group row">
                                                <label for="matricule" class="col-md-4 col-form-label text-md-right">{{ __('Matricule') }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $personnel->matricule ?? '') }}">
                                                    @error('matricule')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        {{-- Nom --}}
                                            <div class="form-group row">
                                                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}<span style="color: red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" required value="{{ old('nom', $personnel->nom ?? '') }}">
                                                    @error('nom')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Prénom --}}
                                            <div class="form-group row">
                                                <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}<span style="color: red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" required value="{{ old('prenom', $personnel->prenom ?? '') }}">
                                                    @error('prenom')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Niveau --}}
                                            <div class="form-group row">
                                                <label for="niveau" class="col-md-4 col-form-label text-md-right">{{ __('Niveau') }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="niveau" id="niveau" class="form-control @error('niveau') is-invalid @enderror" value="{{ old('niveau', $personnel->niveau ?? '') }}">
                                                    @error('niveau')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Telephone --}}
                                            <div class="form-group row">
                                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $personnel->telephone ?? '') }}">
                                                    @error('telephone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- E-mail --}}
                                            <div class="form-group row">
                                                <label for="mail" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                                                <div class="col-md-6">
                                                    <input type="email" name="mail" id="mail" class="form-control @error('mail') is-invalid @enderror" value="{{ old('mail', $personnel->email ?? '') }}">
                                                    @error('mail')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                           
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Informations Suplementaires</legend>
                                        {{-- Genre --}}
                                            <div class="form-group row">
                                                <label for="genre" class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}<span style="color: red">*</span></label>
                                                <div class="col-md-6">
                                                    <select id="genre" class="form-control @error('genre') is-invalid @enderror" name="genre" required autocomplete="genre">
                                                        <option value=""></option>
                                                        @foreach ($genres as $genre)
                                                            <option value="{{ $genre->id }}" {{ old('genre', $personnel->genre ?? '') == $genre->id ? 'selected' : '' }}>
                                                                {{ $genre->libellepers }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ __('formulaire.Obligation') }}
                                                    </div>
                                                    @error('genre')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Type --}}
                                            <div class="form-group row">
                                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}<span style="color: red">*</span></label>
                                                <div class="col-md-6">
                                                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type">
                                                        <option value=""></option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}" {{ old('type', $personnel->type ?? '') == $type->id ? 'selected' : '' }}>
                                                                {{ $type->libellepers }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ __('formulaire.Obligation') }}
                                                    </div>
                                                    @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="rub" value=" {{$rub}} ">
                                    <input type="hidden" name="srub" value=" {{$srub}} ">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                <a href="{{route('personnel.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection