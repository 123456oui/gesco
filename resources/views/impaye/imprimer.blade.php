@extends('layouts.template')

@section('content')
    <div id="print-section" class="container mt-4">
        <h3 class="text-center mb-4">
            Liste des élèves impayés - Classe : <strong>{{ $classe }}</strong> / Année : <strong>{{ $annee }}</strong>
        </h3>

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>Matricule</th>
                    <th>Nom complet</th>
                    <th>Montant dû</th>
                    <th>Montant payé</th>
                    <th>Reste</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $eleve)
                    @php
                        $montant_total = DB::table('inscriptions')
                            ->where('Matricule', $eleve->Matricule)
                            ->where('idanneescolaire', $annee)
                            ->value('montantscolariteE') ?? 0;

                        $montant_paye = DB::table('reglements')
                            ->where('id_eleve', $eleve->Matricule)
                            ->where('annee', $annee)
                            ->sum('montant');

                        $reste = $montant_total - $montant_paye;
                    @endphp
                    <tr>
                        <td>{{ $eleve->Matricule }}</td>
                        <td>{{ $eleve->Nom }} {{ $eleve->Prenom }}</td>
                        <td class="text-end">{{ number_format($montant_total, 0, ',', ' ') }} F</td>
                        <td class="text-end">{{ number_format($montant_paye, 0, ',', ' ') }} F</td>
                        <td class="text-end" style="color: red"><strong>{{ number_format($reste, 0, ',', ' ') }} F</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                    window.location.href = "{{ url('impaye/' . $rub . '/' . $srub) }}";
                }, 100);
            };
        }, 500);
    });
</script>


@endsection


