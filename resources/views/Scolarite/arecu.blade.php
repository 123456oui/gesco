@extends('layouts.template')

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

@section('content')
<div class="container mt-4 recu-container" id="recu-container">
    <h4 class="text-center">REÇU DE PAIEMENT de {{$type}}</h4>
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
            <h5 class="text-center" > ELITE PLUS </h5>
    </div>

    <div class="infosniveau">
        <div class="niveau">
            <div class="mr-2">
                <p>Monsieur/Madame</p>
                <p>A Verser la somme de</p>
                <p>Pour l'année accadémique</p>
            </div>
        </div>

        <div class="classe">
            <div>
                <p><strong>{{ $eleves->Nom }} {{ $eleves->Prenom }}</strong></p>
                <p>de</p>
                <p><strong>{{ session('annee') }}</strong></p>
            </div>
        </div>

        <div class="niveau">
            <div>
                <p>Matricule {{ $eleves->Matricule }}</p>
                <p><strong>{{ number_format( $montant, 0, ',', ' ') }} FCFA</strong></p>
                <p><strong>pour le paiement de {{$type}}</strong></p>
            </div>
        </div>
    </div>


    <div class="signature">
        <div>
            <p><strong>Caissier (caissière)</strong></p>
        </div>
        <div>
            <em>Ouagadougou le {{ now()->isoFormat('LL') }}</em>
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

            const printWindow = window.open('', '_blank', 'width=900,height=600');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Reçu de paiement</title>
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

            setTimeout(function () {
                printWindow.close();
                window.location.href = "{{ url('Scolarite/' . $rub . '/' . $srub) }}";
            }, 2000);
        }, 1000);
    };
</script>
@endsection
