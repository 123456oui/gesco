<x-guest-layout>
      <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="logo">
    <img class="logo" src="{{asset('images/logo.png')}}" alt="" >
    </div>
    
    <form method="POST" action="{{ route('login') }}"class="p-3 mt-4">
                        @csrf

                        <div  class=" form-field d-flex align-items-center">
                            <label for="email">{{ __('Identifiant :') }}</label>

                            <div class="col-md-7">
                                <x-text-input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('Email :') }}" required autocomplete="email" autofocus/>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" form-field d-flex align-items-center">
                            <label for="password" >{{ __('Mot de passe :') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <x-primary-button class="btn  mt-2 bg-success text-white">
                    
                                    {{ __('Connexion') }}
                                                  
                        </x-primary-button>
                       
                     
                       
                    </form>
 </x-guest-layout>
