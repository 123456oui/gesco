@extends('layouts.template')

@section('content')
<div class="container py-4 ">

    {{-- ✅ Partie 1 : Alerte selon la scolarité --}}
    <div class="mb-4" id="info-section">
        @if (0 >= $total)
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
    <div class="mb-4  shadow-sm  w-50 mx-auto px-3 py-1" id="carte-section"  style="background-color:rgba(241, 127, 51, 0.9); ">
        <div class="card-body d-flex flex-column justify-content-between  w-100 h-40"  style="background-color:white;">

            {{-- ✅ En-tête --}}
            <div class="d-flex align-items-center justify-content-between border-bottom " style="background-color:rgba(255, 255, 255, 0.88);">

                {{-- ✅ Image gauche --}}
                <div class="flex-shrink-0" style="width: 80px;">
                    <img src="{{ asset('/images/armoirie2.png') }}" alt="Logo gauche" style="height: 100px;">
                </div>

                {{-- ✅ Texte central (utilise flex-grow pour centrer automatiquement) --}}
                <div class="flex-grow-1 text-center px-3">
                    <h6  class="mb-0 text-uppercase"> <strong>Burkina Faso </strong></h6>
                    <small class="d-block fst-italic">La Patrie ou la Mort - Nous Vaincrons.</small>
                    <h9 class="mt-1 mb-0">ECOLE MATERNELLE PRIMAIRE PRIVEE LES ELITES PLUS</h9>
                    <small class="d-block fst-italic">{{ session('annee') }}</small>
                </div>

                {{-- ✅ Image droite (collée à droite) --}}
                <div class="flex-shrink-0 text-end" style="width: 80px;">
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo droit" style="height: 100px;">
                </div>

            </div>


            {{-- ✅ Corps : 3 parties alignées horizontalement --}}
            <div class="d-flex justify-content-between border-bottom align-items-center py-2">

                {{-- Partie gauche : image avec largeur ajustée à son contenu --}}
                <div class="flex-shrink-0 me-1 text-center">
                    <img src="{{ $eleve->Photo ?? asset('images/default-avatar.png') }}" 
                        alt="Photo élève" 
                        class="img-thumbnail mb-1"
                        style="width: 150px; height: 150px; border-radius: 0%; object-fit: cover;">

                    <p class="mb-0"><strong> <small > </small></strong></p>
                </div>
                {{-- Partie centre --}}
                <div class="w-50 text-start px-3">
                    <p class="mb-1"><strong>Matricule     </strong></p>
                    <p class="mb-1"><strong>Nom     </strong></p>
                    <p class="mb-1"><strong>Prenom  </strong></p>
                    <p class="mb-1"><strong>Date De Naissance </strong></p>
                    <p class="mb-1"><strong>Lieu De Naissance </strong></p>

                </div>

                {{-- Partie droite --}}
                <div class="w-50 text-start">
                     <p class="mb-1"><strong class="mr-3">  : </strong>{{ $eleve->Matricule ?? '...' }}  </p>
                    <p class="mb-1"><strong class="mr-3">  : </strong>{{$eleve->Nom }}   </p>
                    <p class="mb-1"><strong class="mr-3">  : </strong>{{$eleve->Prenom }}   </p>
                    <p class="mb-1"><strong class="mr-3">  : </strong>{{$eleve->datenais}}   </p>
                    <p class="mb-1"><strong class="mr-3">  : </strong>{{$eleve->lieunais }}   </p>
                </div>
                
            </div>


            {{-- ✅ Pied de carte --}}
            <div class="d-flex justify-content-between mt-2 pt-1" style="background-color:rgba(229, 252, 250, 0.73);">
                {{-- Partie gauche --}}
                <div class="text-start">
                    <small> <strong>Personnes a prevenir en cas de besoin:  </strong></small> <br>
                    <small>{{$eleve->Nomp}} ou {{$eleve->Nomm}} </small><br>
                    <small>{{$eleve->NumtelP}} ou {{$eleve->NumtelM}} </small>
                </div>

                {{-- Partie droite --}}
                <div class="text-end">
                    <small> <strong>GROUPE SCOLAIRE LES ELITES </strong></small> <br>
                    <small>UNE EDUCATION UN SAVOIR UN CITOYEN</small>
                </div>
            </div>


        </div>
    </div>


    {{-- ✅ Partie 3 : Impression / Reçu --}}
    <div id="impression-section " class="text-end">
        {{-- À compléter avec un bouton ou un aperçu imprimable --}}
        <button class="btn btn-primary" @if($total<=0) disabled @endif onclick="imprimerCarte()">
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

<script>
function imprimerCarte() {
    var printContents = document.getElementById('carte-section').outerHTML;

    const styles = [...document.querySelectorAll('link[rel="stylesheet"], style')]
        .map(style => style.outerHTML)
        .join("\n");

    var printWindow = window.open('', '', 'height=800,width=1000');
    printWindow.document.open();
    printWindow.document.write(`
        <html>
            <head>
                <title></title>
                ${styles}
                <style>
                    body {
                        background: white;
                        margin: 0;
                        padding: 20px;
                    }
                </style>
            </head>
            <body>
                ${printContents}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();

    setTimeout(function () {
        printWindow.print();
        printWindow.close();

        // ✅ Redirection vers l'index après impression
        window.location.href = "{{ url('state/' . $rub . '/' . $srub) }}";// ou une autre route selon ton besoin
    }, 800);
}
</script>



@endsection
