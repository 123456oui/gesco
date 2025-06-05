@extends('layouts.template')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('BILAN VERSEMENT PAR BANQUE') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="GET" action="{{ route('bversement.bilan',['rub' => '$rub', 'srub' => '$srub']) }}">
                            @csrf
                            <div class="form-group mb-3">
                                                                <label for="banque">{{ __('Banques :') }}<span style="color: red">*</span></label>
                                                                <input type="hidden" name="rub" value={{$rub}} >
                                                                 <input type="hidden" name="srub" value={{$srub}} >
                                                                <select name="banque" id="banque" class="form-control">
                                                                    <option value=""></option>
                                                                    @foreach ($banques as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->libellebanque }}</option>
                                                                    @endforeach
                                                                </select>
                              </div>

                              <div class="form-group mb-3">
                                                                <label for="datedebut">{{ __('Date Début :') }}<span style="color: red">*</span></label>
                                                                <input class="form-control @error('datedebut') is-invalid @enderror"
                                                        type="date" name="datedebut" id="datedebut" required
                                                        value="{{ old('datedebut') }}">
                                                                
                              </div>

                               <div class="form-group mb-3">
                                                                <label for="datefin">{{ __('Date  Fin :') }}<span style="color: red">*</span></label>
                                                                <input class="form-control @error('datefin') is-invalid @enderror"
                                                        type="date" name="datefin" id="datedebut" required
                                                        value="{{ old('datefin') }}">
                                                                
                              </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Imprimer')}}" class="btn btn-primary btnEnregistrer"/>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection