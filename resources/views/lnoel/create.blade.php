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
        Liste des élèves Noël – Niveau : <strong>{{ $niveau }}</strong>, Classe : <strong>{{ $classe }}</strong>
    </h3>

    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Montant Noël</th>
                <th>Scolarité versée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eleves as $eleve)
                <tr>
                    <td>{{ $eleve->Matricule }}</td>
                    <td>{{ $eleve->Nom }} {{ $eleve->Prenom }}</td>
                    <td>{{ number_format($eleve->montant_noel, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($eleve->total_reglement, 0, ',', ' ') }} F</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-muted">Total Noël : {{ number_format($eleves->sum('montant_noel'), 0, ',', ' ') }} F</p>
</div>

<script>
window.onload = function () {
    setTimeout(function () {
        const recu = document.getElementById("print-section");
        if (!recu) return;

        const styles = [...document.querySelectorAll('style')]
            .map(tag => tag.outerHTML)
            .join("");

        const printWindow = window.open('', '_blank', 'width=900,height=600');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Impression Noël</title>
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
            window.location.href = "{{ url('lnoel/' . ($rub ?? '') . '/' . ($srub ?? '')) }}";
        }, 2000);
    }, 1000);
};
</script>
@endsection