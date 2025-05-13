@extends('layouts.template')
<style>
    .recu-container {
        background-image: url('{{ asset('images/favicon.png') }}'); /* Remplace par le bon chemin */
        background-size: cover;
        background-position: center;
        padding: 40px;
        position: relative;
        color: #000;
    }

    .recu-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.85); /* voile blanc semi-transparent */
        z-index: 0;
    }

    .recu-container * {
        position: relative;
        z-index: 1;
    }
    .logos {
        display: flex;
        justify-content: space-between; /* Logo1 à gauche, Logo2 à droite */
        align-items: center;
        margin-bottom: 20px;
    }

    .logo1 img, .logo2 img {
        height: 250px; /* Ajuste selon tes besoins */
    }
    .infosniveau {
    display: flex;  /* Pour placer les sous-divs horizontalement */
    background-color: #f0f0f0;  /* Fond gris clair */
  /* Espacement autour des sous-divs */
    border-radius: 8px;  /* Bords arrondis */
    height: 200px !important;
}

.cycle, .niveau, .classe {
    margin-right:0;
    width: 33%;
    display: flex;                /* Active le mode flex */
    justify-content: center;     /* Centre horizontalement */
    align-items: center;         /* Centre verticalement */
    height: 100%; 
}
.tableau {
    margin-top: 20px;
    padding: 10px;
    background-color: #f9f9f9;  /* Fond léger */
    border-radius: 8px;
    overflow-x: auto; /* Pour gérer le débordement si le tableau est large */
}

.tableau table {
    width: 100%;
    border-collapse: collapse;
}

.tableau th, .tableau td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

.tableau th {
    background-color: #e0e0e0;
}
.signature{
    margin-top:20px;
    height: 100px;
    text-align: right;
}
</style>

@section('content')
<div class="container mt-4 recu-container" id="recu-container">
    <h4 class="text-center">REÇU DE PAIEMENT</h4>
    <hr>
    <div class="logos" id="logos">
        <div class="logo1">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo 1">
        </div>
        <div class="logo2">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo 2">
        </div>
    </div>
    <div class="etablissement mt-2 mb-2">
            <h5 class="text-center" > NOM DE L ETABLISEMENT </h5>
    </div>
    <div class="infosniveau">
         <div class="cycle">
         <img src="{{ $reglement->eleve->Photo }}" style="width: 100%; height: 100%; border-radius:10%;"   alt="Photo de l'élève">
         </div>
         <div class="niveau">
            <div class="mr-2">
            <p><strong >Matricule de l élève :</strong> </p>
            <p><strong >Nom  de l élève :</strong> </p>
            <p><strong >Classe :</strong></p>
            <p><strong >Année scolaire :</strong></p>
            </div>
            <div>
            <p> {{ $reglement->eleve->Matricule }}</p>
            <p> {{ $reglement->eleve->Nom }} {{ $reglement->eleve->Prenom }}</p>
            <p>{{ $classe->libelleclasse }}</p>
            <p> {{ $reglement->annee }}</p>
            </div>
        </div>
         <div class="classe">
            <div class="mr-3">
         <p><strong>Banque :</strong></p>
         <p><strong>Montant payé :</strong> </p>
         <p><strong>Date :</strong> </p>
            </div>
            <div>
         <p> {{ $reglement->banque->libellebanque }}</p>
         <p>{{ number_format($reglement->montant, 0, ',', ' ') }} FCFA</p>
         <p>{{ $reglement->created_at->isoFormat('LL') }}</p>
            </div>
         </div>
    </div>
    <div class="etablissement mt-2 mb-2">
            <h5 class="text-center" >PAYEMENT ULTERIEUR </h5>
    </div>
    <div class="tableau">
            <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Banque</th>
                </tr>
            </thead>
            <tbody>
                @forelse($autresReglements as $autre)
                    <tr>
                        <td>{{ $autre->created_at->isoFormat('LL') }}</td>
                        <td>{{ number_format($autre->montant, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $autre->banque->libellebanque ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Aucun autre règlement trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

            <p style="text-align: right;"> <em> <strong> total payer :</strong>{{ $montantTotalAutres}}  FCFA</em> </p>
            <p style="text-align: right;"> <em> <strong> reste a payer :</strong>{{ $rest}}  FCFA</em> </p>
        </div>
        <div class="signature" >
            <div>
                <p > <strong>Caissier (caissiere)</strong></p>
            </div>
            <div>
            <em>Ouagadougou le {{now()->isoFormat('LL')}}</em>
            </div>
        </div>
</div>
<script>
    window.onload = function () {
    setTimeout(function () {
        const recu = document.getElementById("recu-container");
        if (!recu) return;

        const styles = [...document.querySelectorAll('link[rel="stylesheet"], style')]
            .map(tag => tag.outerHTML)
            .join("\n");

        // Ouvre une nouvelle fenêtre pour l'impression
        const printWindow = window.open('', '_blank', 'width=900,height=600');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title></title>
                    ${styles}
                    <style>
                        @page { size: auto; margin: 0; }
                        body { margin: 0; padding: 9; }
                    </style>
                </head>
                <body>
                    ${recu.outerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
        };

        // Utilisation de setTimeout pour rediriger après l'impression
        setTimeout(function() {
            printWindow.close();
            // Redirection après un délai (environ 2 secondes après l'impression)
            window.location.href = "{{ url('intendance/' . $rub . '/' . $srub) }}";
        }, 2000); // Tu peux ajuster le délai si nécessaire
    }, 1000);
};
</script>
@endsection 