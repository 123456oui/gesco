@extends('layouts.template')

@section('content')
    <div id="print-section" class="container mt-4">
        <h3 class="text-center mb-4">
            Liste des élèves pour APE du 
            <strong>{{ \Carbon\Carbon::parse($dateDebut)->translatedFormat('j F Y') }}</strong> au 
            <strong>{{ \Carbon\Carbon::parse($dateFin)->translatedFormat('j F Y') }}</strong>
        </h3>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>Matricule</th>
                    <th>Nom complet</th>
                    <th>Scolarite payé</th>
                    <th>Montant APE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $eleve)
                    <tr>
                       <td>{{ $eleve->Matricule }}</td>
                        <td>{{ $eleve->Nom }} {{ $eleve->Prenom }}</td>
                        <td>{{ number_format($eleve->total, 0, ',', ' ') }} F</td>
                        <td>{{ number_format(5000, 0, ',', ' ') }} F</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-muted text-right mx-5" style="align: right; text-align: right;">Total APE : {{ $total }} F</p>
    </div>

<script>
    window.addEventListener('load', function () {
        setTimeout(() => {
            const content = document.getElementById('print-section').innerHTML;

            const printWindow = window.open('', '', 'width=800,height=600');

            printWindow.document.write(`
                <html>
                    <head>
                        <title>Impression</title>
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                        <style>
                            body {
                                padding: 20px;
                            }
                        </style>
                    </head>
                    <body>
                        ${content}
                    </body>
                </html>
            `);

            printWindow.document.close();

            printWindow.onload = function () {
                printWindow.focus();
                printWindow.print();

                // Après impression, ferme la fenêtre enfant, et redirige la fenêtre parent
                setTimeout(() => {
                    printWindow.close();
                    // Redirige la fenêtre parent
                    window.location.href = "{{ url('ape/' . $rub . '/' . $srub) }}";
                }, 100);
            };
        }, 500);
    });
</script>


@endsection


