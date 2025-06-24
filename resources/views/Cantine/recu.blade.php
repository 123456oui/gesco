@extends('layouts.template')

@section('content')
<style>
    .recu-container {
        background-image: url('{{ asset('images/favicon.png') }}');
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
        background: rgba(255, 255, 255, 0.85);
        z-index: 0;
    }

    .recu-container * {
        position: relative;
        z-index: 1;
    }

    .logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo1 img, .logo2 img {
        height: 250px;
    }

    .infosniveau {
        display: flex;
        background-color: #f0f0f0;
        border-radius: 8px;
        height: 200px !important;
    }

    .cycle, .niveau, .classe {
        margin-right: 0;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        flex-direction: column;
    }

    .tableau {
        margin-top: 20px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 8px;
        overflow-x: auto;
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

    .signature {
        margin-top: 20px;
        height: 100px;
        text-align: right;
    }
</style>

<div class="container mt-4 recu-container" id="recu-container">
    <h4 class="text-center">REÇU DE PAIEMENT</h4>
    <hr>
    <div class="logos" id="logos">
        <div class="logo1">
            <img src="{{ asset('images/armoirie2.png') }}" alt="Logo 1">
        </div>
        <div class="logo2">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo 2">
        </div>
    </div>
    <div class="etablissement mt-2 mb-2">
        <h5 class="text-center">ELITE PLUS </h5>
    </div>
    <div class="infosniveau">
        <div class="niveau">
            <p>Monsieur/Madame</p>
            <p>En classe</p>
            <p>À verser la somme de</p>
            <p>Pour la cantine de </p>
        </div>
        <div class="classe">
            <p><strong>{{ $inscription->Nom ?? '' }} {{ $inscription->Prenom ?? '' }}</strong></p>
            <p>de</p>
            <p><strong>{{ $lettres ?? '' }}  FCFA</strong></p>
           <p><strong>{{ implode(', ', $moisNoms ?? []) }}</strong></p>
        </div>
        <div class="niveau">
            <p>Matricule {{ $inscription->Matricule ?? '' }}</p>
            <p><strong>{{ $inscription->libelleclasse ?? '' }}</strong></p>
            <p><strong>{{ number_format($total ?? 0, 0, ',', ' ') }} FCFA</strong></p>
            <p>pour l annee {{ $annee ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="etablissement mt-2 mb-2">
        <p style="text-align: right;">
            <em><strong>Total payé :</strong> {{ number_format($montantTotalAutres ?? $total, 0, ',', ' ') }} FCFA</em>
        </p>
        <h5 class="text-center">PAIEMENTS ULTERIEURS</h5>
    </div>

    <div class="tableau">
        <table>
            <thead>
                <tr>
                    <th>mois</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @forelse($autresCantines ?? [] as $autre)
                    <tr>
                        <td>{{$autre->nom_mois }}</td>
                        <td>{{  session('cantinesome')}} FCFA</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Aucun autre règlement trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="signature">
        <p><strong>Caissier (caissière)</strong></p>
        <em>Ouagadougou le {{ now()->isoFormat('LL') }}</em>
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

        const printWindow = window.open('', '_blank', 'width=900,height=600');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Reçu de paiement</title>
                    ${styles}
                    <style>
                        @page { size: auto; margin: 0; }
                        body { margin: 0; padding: 9px; }
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

        setTimeout(function () {
            printWindow.close();
            window.location.href = "{{ url('cantine/' . $rub . '/' . $srub) }}";
        }, 2000);
    }, 1000);
};
</script>
@endsection
