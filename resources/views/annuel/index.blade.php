@extends('layouts.template')
@section('content')

<div class="container-fluid">
    <div class="row h-90 align-items-center justify-content-center">
        <!-- Card Scolarité -->
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px;">
                <div class="card-body d-flex align-items-center flex-column justify-content-between h-100">
                    <!-- En-tête : icône + titre -->
                    <div class="d-flex align-items-center mb-3 w-100" style="gap: 18px;background-color:#ecf0f1;">
                        <span style="font-size:2.5rem; color:#2980b9;">
                            <i class="fas fa-university fa-5x"></i>
                        </span>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#2980b9; font-size:30px;"> Scolarité</h5>
                    </div>
                    <!-- Valeur principale -->
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center w-100"
                        style="background-color:#ecf0f1; border-radius:5px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:400px; height:auto;">
                        <h2 class="card-text" style="font-weight:bold; font-size:2.3rem; color:#222;">
                            {{ $statScolarite ?? '0' }} <span style="font-size:1.2rem; color:#888;">FCFA</span>
                        </h2>
                    </div>
                    <!-- Pied de card : infos complémentaires -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;">Total encaissé</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Cantine -->
       <div class="col-md-6 mb-3">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px;">
                <div class="card-body d-flex align-items-center flex-column justify-content-between h-100">
                    <!-- En-tête : icône + titre -->
                    <div class="d-flex align-items-center mb-3 w-100" style="gap: 18px;background-color:#ecf0f1;">
                        <span style="font-size:2.5rem; color:#2980b9;">
                            <i class="fas fa-utensils fa-5x"></i>
                        </span>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#2980b9; font-size:30px;"> Cantine</h5>
                    </div>
                    <!-- Valeur principale -->
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center w-100"
                        style="background-color:#ecf0f1; border-radius:5px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:400px; height:auto;">
                        <h2 class="card-text" style="font-weight:bold; font-size:2.3rem; color:#222;">
                            {{ $statScolarite ?? '0' }} <span style="font-size:1.2rem; color:#888;">FCFA</span>
                        </h2>
                    </div>
                    <style>
                        .flex-grow-1::-webkit-scrollbar {
                            display: none;
                        }
                    </style>
                    <!-- Pied de card : infos complémentaires -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;">Total encaissé</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection