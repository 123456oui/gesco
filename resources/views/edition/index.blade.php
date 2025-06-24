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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Edition des Elèves par Classe') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="GET" action="{{ route('editclasse.editclasse',['rub' =>' $rub', 'srub' => '$srub']) }} ">
                            @csrf
                            <div class="form-group mb-3">

					<label for="cycle">{{ __('Cycle:') }}<span style="color: red">*</span></label>
                     

                                    		<select name="cycle" id="cycle" class="formulaire" data-next="niveau" onchange="showSelectioneEdite(this)">
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

                                                               
                              </div>

                          <div class="form-group mb-3">
					
                   			<label for="niveau">{{ __('Niveau:') }}<span style="color: red">*</span></label>

                     			<select name="niveau" id="niveau" class="formulaire"  onchange="showclasseEdite(this)" >
                        
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

                         <div class="form-group mb-3">

                   		  <label for="classe">{{ __('Classe:') }}<span style="color: red">*</span></label>
                     

                  	  	 <select name="classe" id="classe" class="formulaire"  onchange="">
                        
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