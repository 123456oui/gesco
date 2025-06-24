
@extends('layouts.template')
@section('content')

<div class="container-fluid">
    <div class="row h-90 align-items-center justify-content-center">

        <!-- Card Scolarité -->
        <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <!-- En-tête -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2 p-3 border rounded shadow-sm" style="background-color: #f8f9fa;">
                    <div>
                        <i class="fas fa-university fa-3x trembe text-success mx-3"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-1 fw-bold text-primary" style="font-size: 22px;">Scolarité : <span class="mx-3"> <span class="mx-2 text-danger">{{ number_format($letotaldesversement, 0, ',', ' ') }} FCFA </span></span></h5>
                        <h5 class="mb-1 fw-bold text-primary" style="font-size: 22px;">APE : <span class="mx-3"> <span class="mx-2 text-danger">{{ number_format($ape, 0, ',', ' ') }} FCFA </span></span></h5>
                    </div>
                </div>
                    <!-- Corps : par classe -->
                    <div class="flex-grow-1 d-flex flex-column align-items-center w-100"
                        style="background-color:#f7f9f9; border-radius:10px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:500px; padding: 10px;">
                        @foreach($classesWithInscriptions as $classe)
                            <div class="mb-3 p-3 w-100 class-card"
                                style="background:#fff; border-radius:15px; box-shadow:0 2px 12px rgba(41,128,185,0.10); border-left:7px solid #27ae60; border-bottom:3px solid #27ae60; transition:box-shadow .2s;">
                                <div class="d-flex align-items-center mb-2 gap-3">
                                    <i class="fas fa-chalkboard text-success mx-2"></i>
                                    <span class="fw-bold text-primary" style="font-size:1.3rem;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-3 mb-2">
                                        <i class="fas fa-users text-dark"></i>
                                        <div>Inscriptions</div>
                                        <div class="fw-bold">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <div>À jour</div>
                                        <div class="fw-bold">{{ $classe->ajours }}</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <i class="fas fa-coins tremb text-warning"></i>
                                        <div>Total attendu</div>
                                        <div class="fw-bold">{{ number_format($classe->tatalinscription, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-2">
                                        <i class="fas fa-wallet  text-info"></i>
                                        <div>Total versé</div>
                                        <div class="fw-bold">{{ number_format($classe->totalverserr, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de carte -->
                    <div class="text-end mt-2 w-100">
                        <small class="text-success fw-bold">
                            Total encaissé :
                            <span class="mx-2 text-dark">{{ number_format($letotaldesversement, 0, ',', ' ') }} FCFA</span>
                            /
                            <span class="mx-2 text-dark">{{ number_format($letotaldesinscription, 0, ',', ' ') }} FCFA</span>
                            <span class="ms-4">Somme Due :
                                <span class="text-danger ms-2">{{ number_format($letotaldesinscription - $letotaldesversement, 0, ',', ' ') }} FCFA</span>
                            </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Cantine -->
        <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex align-items-center flex-column justify-content-between h-100">
                    <!-- En-tête : icône + titre -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 p-3 border rounded shadow-sm" style="background-color: #f8f9fa; width: 100%;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-utensils fa-3x text-success mx-3 trembe"></i>
                            <h5 class="mb-0 fw-bold text-primary" style="font-size: 22px;">Cantine :</h5>
                        </div>
                        <h5 class="mb-0 fw-bold text-danger" style="font-size: 22px;">
                            {{ number_format($cantinetotal * session('cantinesome'), 0, ',', ' ') }} FCFA
                        </h5>
                    </div>
                    <!-- Valeur principale -->
                    <div class="flex-grow-1 d-flex flex-column align-items-center w-100"
                        style="background-color:#f7f9f9; border-radius:10px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:500px; padding: 10px;">
                        @foreach($cantinesByClasse as $classe)
                            <div class="mb-3 p-3 w-100 class-card"
                                style="background:#fff; border-radius:15px; box-shadow:0 2px 12px rgba(41,128,185,0.10); border-left:7px solid  #27ae60; border-bottom:3px solid #27ae60; transition:box-shadow .2s;">
                                <div class="d-flex align-items-center mb-2 gap-3">
                                    <i class="fas fa-chalkboard text-success mx-2"></i>
                                    <span class="fw-bold" style="font-size:1.3rem; color:#2980b9;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-users text-dark"></i>
                                        <div>Inscriptions</div>
                                        <div class="fw-bold">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-user-check text-success"></i>
                                        <div>Inscrits</div>
                                        <div class="fw-bold">{{ $classe->nombredinscriptionavecantine }}</div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <i class="fas fa-coins tremb text-warning"></i>
                                        <div>Total cantine</div>
                                        <div class="fw-bold">{{ number_format($classe->totalcantine * session('cantinesome'), 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de card : infos complémentaires -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#27ae60;"> Total encaissé :<span class="ml-2">  {{ number_format($cantinetotal * session('cantinesome'), 0, ',', ' ') }} FCFA </span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Noël -->
        <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <!-- En-tête -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 p-3 border rounded shadow-sm" style="background-color: #f8f9fa;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-tree fa-3x trembe mx-3" style="color:#27ae60;"></i>
                            <h5 class="mb-0 fw-bold" style="font-size: 22px; color:#2980b9;">Noël :</h5>
                        </div>
                        <h5 class="mb-0 fw-bold" style="font-size: 22px; color:#cd6155;">
                            {{ number_format($total_noel , 0, ',', ' ') }} FCFA
                        </h5>
                    </div>
                    <!-- Corps : par classe -->
                    <div class="flex-grow-1 d-flex flex-column align-items-center w-100"
                        style="background-color:#f7f9f9; border-radius:10px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:500px; padding: 10px;">
                        @foreach($classesWithInscriptions as $classe)
                            <div class="mb-3 p-3 w-100 class-card"
                                style="background:#fff; border-radius:15px; box-shadow:0 2px 12px rgba(41,128,185,0.10); border-left:7px solid #27ae60; border-bottom:3px solid #27ae60; transition:box-shadow .2s;">
                                <div class="d-flex align-items-center mb-2 gap-3">
                                    <i class="fas fa-chalkboard text-success mx-2"></i>
                                    <span class="fw-bold" style="font-size:1.3rem; color:#2980b9;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-users text-dark"></i>
                                        <div>Inscriptions</div>
                                        <div class="fw-bold">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <div>À jour</div>
                                        <div class="fw-bold">{{ $classe->noel_nombre }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-coins tremb text-warning"></i>
                                        <div>Total versé</div>
                                        <div class="fw-bold">{{ number_format($classe->noel_total, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de carte -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;">Total encaissé : <span class="mr-3 ml-2">{{ number_format($total_noel, 0, ',', ' ') }} FCFA </span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Clôture -->
        <div class="col-md-6 mb-0">
            <div class="card shadow h-100 d-flex flex-column justify-content-between" style="min-height:220px; background-color:#f7f9f9;">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <!-- En-tête -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 p-3 border rounded shadow-sm" style="background-color: #f8f9fa;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-glass-cheers fa-3x trembe mx-3" style="color:#27ae60;"></i>
                            <h5 class="mb-0 fw-bold" style="font-size: 22px; color:#2980b9;">Clôture :</h5>
                        </div>
                        <h5 class="mb-0 fw-bold" style="font-size: 22px; color:#cd6155;">
                            {{ number_format($total_cloture, 0, ',', ' ') }} FCFA
                        </h5>
                    </div>
                    <!-- Corps : par classe -->
                    <div class="flex-grow-1 d-flex flex-column align-items-center w-100"
                        style="background-color:#f7f9f9; border-radius:10px; overflow-y:auto; scrollbar-width:none; -ms-overflow-style:none; max-height:500px; padding: 10px;">
                        @foreach($classesWithInscriptions as $classe)
                            <div class="mb-3 p-3 w-100 class-card"
                                style="background:#fff; border-radius:15px; box-shadow:0 2px 12px rgba(41,128,185,0.10); border-left:7px solid #27ae60; border-bottom:3px solid #27ae60; transition:box-shadow .2s;">
                                <div class="d-flex align-items-center mb-2 gap-3">
                                    <i class="fas fa-chalkboard text-success mx-2"></i>
                                    <span class="fw-bold" style="font-size:1.3rem; color:#2980b9;">
                                        {{ $classe->libelleclasse ?? 'Classe' }}
                                    </span>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-users text-dark"></i>
                                        <div>Inscriptions</div>
                                        <div class="fw-bold">{{ $classe->nombredinscription }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <div>À jour</div>
                                        <div class="fw-bold">{{ $classe->cloture_nombre }}</div>
                                    </div>
                                    <div class="col-6 col-md-4 mb-2">
                                        <i class="fas fa-coins tremb text-warning"></i>
                                        <div>Total versé</div>
                                        <div class="fw-bold">{{ number_format($classe->cloture_total, 0, ',', ' ') }} FCFA</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pied de carte -->
                    <div class="text-end mt-2 w-100">
                        <small style="color:#16a085;">Total encaissé : <span class="mr-3 ml-2">{{ number_format($total_cloture, 0, ',', ' ') }} FCFA </span></small>
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
        }, 3000);
    };
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
.class-card:hover {
    box-shadow: 0 4px 24px rgba(41,128,185,0.18);
    border-left: 7px solid #138d75 !important;
    border-bottom: 3px solid #138d75 !important;
    transform: translateY(-2px) scale(1.01);
    transition: box-shadow .2s, transform .2s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let zoomCount = 0;
    function zoomIcons() {
        if (zoomCount < 4) {
            document.querySelectorAll('i.trembe').forEach(icon => {
                icon.classList.add('fa-zoom-custom');
            });
            setTimeout(() => {
                document.querySelectorAll('i.trembe').forEach(icon => {
                    icon.classList.remove('fa-zoom-custom');
                });
                zoomCount++;
                zoomIcons();
            }, 500);
        } else {
            zoomCount = 0;
            setTimeout(zoomIcons, 150000);
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