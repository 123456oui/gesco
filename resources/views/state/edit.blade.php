@extends('layouts.template')

@section('content')
<div class="container py-4 ">

    {{-- ✅ Partie 1 : Alerte selon la scolarité --}}
    <div class="mb-4" id="info-section">
        @if ($scolarite > $total)
            <div class="alert alert-danger" id="alerte-scolarite">
                <strong>Attention !</strong> Vous devez d'abord payer la scolarité de l'élève avant de pouvoir imprimer la carte scolaire.
            </div>
        @else
            <div class="alert alert-success" id="alerte-scolarite">
                <strong>Succès !</strong> Vous pouvez maintenant imprimer la carte scolaire.
            </div>
        @endif
    </div>

    {{-- ✅ Partie 2 : Carte scolaire --}}
    <div class="mb-4  shadow-sm  w-50 mx-auto px-3 py-1" id="carte-section"  style="background-color:rgba(208, 254, 241, 0.98); ">
        <div class="card-body d-flex flex-column justify-content-between  w-100 h-40"  style="background-color:white;">

            {{-- ✅ En-tête --}}
            <div class="d-flex align-items-center justify-content-between border-bottom " style="background-color:rgba(255, 255, 255, 0.88);">

                {{-- ✅ Image gauche --}}
                <div class="flex-shrink-0" style="width: 100px;">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo gauche" style="height: 100px;">
                </div>

                {{-- ✅ Texte central (utilise flex-grow pour centrer automatiquement) --}}
                <div class="flex-grow-1 text-center px-3">
                    <h6  class="mb-0 text-uppercase"> <strong>Burkina Faso </strong></h6>
                    <small class="d-block fst-italic">Unité - Progrès - Justice</small>
                    <h5 class="mt-1 mb-0">Lycée de l’Avenir</h5>
                    <strong class="d-block mt-1">Carte Scolaire</strong>
                </div>

                {{-- ✅ Image droite (collée à droite) --}}
                <div class="flex-shrink-0 text-end" style="width: 100px;">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo droit" style="height: 100px;">
                </div>

            </div>


            {{-- ✅ Corps : 3 parties alignées horizontalement --}}
            <div class="d-flex justify-content-between text-center py-4 flex-grow-1">

                {{-- Partie gauche --}}
                <div class="w-33">
                    <p><strong>Nom :</strong></p>
                    <p>{{ $eleve->Nom ?? '...' }}</p>
                </div>

                {{-- Partie centre --}}
                <div class="w-33">
                    <p><strong>Matricule :</strong></p>
                    <p>{{ $eleve->Matricule ?? '...' }}</p>
                </div>

                {{-- Partie droite --}}
                <div class="w-33">
                    <p><strong>Classe :</strong></p>
                    <p>{{ $eleve->Classe ?? '...' }}</p>
                </div>
            </div>

            {{-- ✅ Pied de carte --}}
            <div class="text-end border-top pt-2">
                <small>Ouagadougou, le {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</small>
            </div>

        </div>
    </div>


    {{-- ✅ Partie 3 : Impression / Reçu --}}
    <div id="impression-section">
        {{-- À compléter avec un bouton ou un aperçu imprimable --}}
        <button class="btn btn-primary" @if($scolarite > $total) disabled @endif>
            <i class="fas fa-print me-1"></i> Imprimer la carte scolaire
        </button>
    </div>

</div>

<script>
    window.onload = function () {
        setTimeout(function () {
            const alerte = document.getElementById('alerte-scolarite');
            if (alerte) {
                alerte.style.transition = "opacity 1s";
                alerte.style.opacity = 0;
                setTimeout(() => alerte.remove(), 1000); // Supprimer après fondu
            }
        }, 5000); // 60000 ms = 1 minute
    };
</script>
@endsection
