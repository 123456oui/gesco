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
<div class="container mt-4 recu-container" id="bilan-container">
    <h4 class="text-center">Bilan versement</h4>
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
            <h5 class="text-center" > Banque : <strong>{{$banque}}</strong></h5>
    </div>
     <div class="etablissement mt-2 mb-2">
            <h5 class="text-center" > Versement du <strong>{{$debut}}</strong> au <strong>{{ $fin}}</strong> </h5>
    </div>
    <div class="container-fluid">
    <div class="main-card card">
        
   	 <div class="card-body table-responsive">
     	   <table id="example" class="table table-striped table-bordered table-hover ">
        
       	     <thead >
                <tr>
                    <th>{{__('Matricule')}} </th>
                   <th>{{__('Nom ')}} </th>
                   <th>{{__('Prenom(s) ')}} </th>
                   <th>{{__('Montant ')}} </th>
                   <th>{{__('Date Règlement ')}} </th>



                
                </tr>
            </thead>
            
            <tbody>
                @foreach($bversement as $item)
                    <tr>
                        <td>{{$item->id_eleve}}</td>
                        <td>{{$item->eleve->Nom}}</td>
                        <td>{{$item->eleve->Prenom}}</td>
                        <td>{{$item->montant}}</td>
                        <td>{{$item->created_at}}</td>  
                    </tr>
                @endforeach
               
            </tbody>
            
        </table>
        
    	</div>
        <div><p> La somme total des versements  est de : <strong>{{ strtoupper($lettres) }}  ( {{ number_format($total, 0, ',', ' ') }}) FCFA</strong>  </p></div>
    </div>

</div>
<script>
window.onload = function () {
    setTimeout(function () {
        const bilan = document.getElementById("bilan-container");
        if (!bilan) {
            console.error("Élément #bilan-container introuvable.");
            return;
        }

        const originalBody = document.body.innerHTML;
        const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
            .map(tag => tag.outerHTML)
            .join("\n");

        document.body.innerHTML = `${styles}${bilan.outerHTML}`;
        window.print();

        // Optionnel : rediriger après impression
        setTimeout(function () {
            window.location.href = "{{ url('bversement/' . $rub . '/' . $srub) }}";
        }, 3000);
    }, 1000);
};


       
</script>
@endsection 