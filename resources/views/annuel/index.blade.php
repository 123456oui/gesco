@extends('layouts.template')
@section('content')

<div class="container-fluid">
    <div class="row h-90 align-items-center justify-content-center">
        <!-- Card Scolarité -->
        <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex align-items-center flex-column justify-content-between h-100">
                    <!-- En-tête : icône + titre -->
                    <div class="d-flex align-items-center mb-0 w-100" style="gap: 8px  ;">
                        <span style="font-size:2.5rem; color:#27ae60;">
                            <i class="fas fa-university fa-3x trembe"></i>
                        </span>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#2980b9; font-size:30px;"> Scolarité :</h5>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#cd6155; font-size:30px;"> {{ number_format($letotaldesversement, 0, ',', ' ') }} FCFA</h5>
                    </div>
                    <!-- Valeur principale -->
                   <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-start w-100"
                        style="background-color:#f7f9f9; border-radius:5px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:400px; height:auto; padding: 10px;">
                        @foreach($classesWithInscriptions as $classe)
                            <div class="mb-3 p-3 w-100"
                                style="background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(41,128,185,0.07); border-left:5px solid #27ae60;border-bottom:2px solid #27ae60;">
                                <div class="d-flex align-items-center mb-2" style="gap: 12px;">
                                    <span style="font-size:2rem; color:#27ae60;">
                                        <i class="fas fa-chalkboard"></i>
                                    </span>
                                    <span style="font-size:1.3rem; font-weight:bold; color:#2980b9;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-3 mb-2">
                                        <span style="font-size:1.2rem; color:#34495e;">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Inscriptions</div>
                                        <div style="font-weight:bold;">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <span style="font-size:1.2rem; color:#27ae60;">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">À jour</div>
                                        <div style="font-weight:bold;">{{ $classe->ajours }}</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <span style="font-size:1.2rem; color:#e67e22;">
                                            <i class="fas fa-coins tremb"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Total attendu</div>
                                        <div style="font-weight:bold;">{{ number_format($classe->tatalinscription, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <span style="font-size:1.2rem; color:#16a085;">
                                            <i class="fas fa-wallet"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Total versé</div>
                                        <div style="font-weight:bold;">{{ number_format($classe->totalverserr, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de card : infos complémentaires -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;">Total encaissé : <span class="mr-3 ml-2">{{ number_format($letotaldesversement, 0, ',', ' ') }} FCFA </span>   / <span class="mr-3 ml-2"> {{ number_format($letotaldesinscription, 0, ',', ' ') }} FCFA </span>  <span class="ml-5">Somme Due : <span class="ml-2" style="color:red;"> {{ number_format($letotaldesinscription-$letotaldesversement, 0, ',', ' ') }} FCFA  </span></span></small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Cantine -->
       <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex align-items-center flex-column justify-content-between h-100">
                    <!-- En-tête : icône + titre -->
                    <div class="d-flex align-items-center mb-0 w-100" style="gap: 8px;">
                        <span style="font-size:2.5rem; color:#27ae60;">
                            <i class="fas fa-utensils fa-3x trembe"></i>
                        </span>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#2980b9; font-size:30px;"> Cantine</h5>
                        <h5 class=" mb-0 ml-4" style="font-weight:bold; color:#cd6155; font-size:30px;">  {{ number_format($cantinetotal * session('cantinesome') , 0, ',', ' ') }} FCFA </h5>
                    </div>
                    <!-- Valeur principale -->
                    <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-start w-100"
                        style=" border-radius:5px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:400px; height:auto; padding: 10px;">
                        @foreach($cantinesByClasse as $classe)
                            <div class="mb-3 p-3 w-100"
                                style="background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(39, 174, 96, 0.07); border-left:5px solid #27ae60;border-bottom:2px solid #27ae60;">
                                <div class="d-flex align-items-center mb-2" style="gap: 12px;">
                                    <span style="font-size:2rem; color:#27ae60;">
                                        <i class="fas fa-chalkboard"></i>
                                    </span>
                                    <span style="font-size:1.3rem; font-weight:bold; color:#2980b9;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-4 mb-2">
                                        <span style="font-size:1.2rem; color:#34495e;">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Inscriptions</div>
                                        <div style="font-weight:bold;">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <span style="font-size:1.2rem; color:#2980b9;">
                                            <i class="fas fa-user-check"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Inscrits </div>
                                        <div style="font-weight:bold;">{{ $classe->nombredinscriptionavecantine }}</div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <span style="font-size:1.2rem; color:#e67e22;">
                                            <i class="fas fa-coins   tremb"></i>
                                        </span>
                                        <div style="font-size:1.1rem;">Total cantine</div>
                                        <div style="font-weight:bold;"> {{ number_format($classe->totalcantine * session('cantinesome'), 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de card : infos complémentaires -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;"> Total encaissé :<span class="ml-2">  {{ number_format($cantinetotal * session('cantinesome'), 0, ',', ' ') }} FCFA </span></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ajoute l'animation tremblement uniquement aux icônes avec la classe 'tremb'
    const shakeIcons = () => {
        document.querySelectorAll('i.tremb').forEach(icon => {
            icon.classList.add('fa-shake-custom');
        });
        setTimeout(() => {
            document.querySelectorAll('i.tremb').forEach(icon => {
                icon.classList.remove('fa-shake-custom');
            });
        }, 3000); // 5 secondes
    };

    // Animation toutes les 15 secondes
    shakeIcons();
    setInterval(shakeIcons, 10000);
});
</script>
<style>
@keyframes shake {
    0% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
    100% { transform: translateX(0); }
}
.fa-shake-custom {
    animation: shake 0.5s linear infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let zoomCount = 0;
    function zoomIcons() {
        if (zoomCount < 4) {
            document.querySelectorAll(' i.trembe').forEach(icon => {
                icon.classList.add('fa-zoom-custom');
            });
            setTimeout(() => {
                document.querySelectorAll(' i.trembe').forEach(icon => {
                    icon.classList.remove('fa-zoom-custom');
                });
                zoomCount++;
                zoomIcons(); // Relance jusqu'à 4 fois
            }, 500); // 3 secondes
        } else {
            zoomCount = 0;
            setTimeout(zoomIcons, 150000); // Relance la séquence après 10 secondes
        }
    }
    zoomIcons();
});
</script>
<style>
@keyframes zoom {
    25% { transform: scale(1);}
    50% { transform: scale(1.4);}
    75% { transform: scale(1);}
}
.fa-zoom-custom {
    animation: zoom 0.5s cubic-bezier(.36,1.64,.56,.99) infinite;
}
</style>
@endsection