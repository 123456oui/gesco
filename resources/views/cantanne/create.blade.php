@extends('layouts.template')

@section('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #fff;
        color: #222;
    }
    .container {
        max-width: 900px;
        margin: 30px auto;
        background: #f9f9f9;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px #eee;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    h3 {
        margin-bottom: 24px;
        color: #2c3e50;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 16px;
    }
    th, td {
        border: 1px solid #bbb;
        padding: 8px 12px;
        text-align: left;
    }
    th {
        background: #e0e0e0;
        color: #333;
    }
    .text-muted {
        color: #888 !important;
        text-align: right;
        margin-right: 30px;
    }
</style>
@endsection

@section('content')
    <div id="print-section" class="container mt-4">
        <h3 class="text-center mb-4">
            Liste des élèves pour cantine de 
            <strong>{{ $dateDebut }}</strong> à
            <strong>{{ $dateFin }}</strong>
        </h3>

        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom complet</th>
                    <th>Montant cantine</th>
                    <th>nombre de mois</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $eleve)
                    <tr>
                        <td>{{ $eleve->matricule }}</td>
                        <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
                        <td>{{ number_format($eleve->montant, 0, ',', ' ') }} F</td>
                        <td>{{ $eleve->nombre_fois }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-muted">Total cantines : {{ $total }} F</p>
    </div>

<script>
    window.onload = function () {
        setTimeout(function () {
            const recu = document.getElementById("print-section");
            if (!recu) return;

            // Récupère tous les styles (y compris le style simple ci-dessus)
            const styles = [...document.querySelectorAll('style')]
                .map(tag => tag.outerHTML)
                .join("");

            const printWindow = window.open('', '_blank', 'width=900,height=600');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Impression</title>
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
                window.location.href = "{{ url('cantanne/' . ($rub ?? '') . '/' . ($srub ?? '')) }}";
            }, 2000);
        }, 1000);
    };
</script>
@endsection


