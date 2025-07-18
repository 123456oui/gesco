@extends('layouts.template')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
  <div class="container">
    <!-- Marquee -->
    <div class="position-relative mb-5">
      <marquee behavior="scroll" direction="left" scrollamount="6"
               class="text-white text-lg font-bold py-2 px-4 rounded shadow-lg text-center"
               style="background-color:rgba(236, 67, 143, 0.8); width: 100%;">
        Elite Plus : Groupe scolaire Maternel, Primaire, Secondaire
      </marquee>
    </div>

    <!-- Cards -->
    <div class="row justify-content-center text-center">
    <!-- Total Élèves -->
    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 py-2">
            <div class="card-body d-flex flex-column align-items-center p-2">
                <div class="text-primary mb-2">
                    <i class="fas fa-user-graduate fa-4x"></i>
                </div>
                <h1 class="fw-bold text-dark mb-1">{{ $eleves ?? 0 }}</h1>
                <p class="text-muted mb-0">Total Élèves</p>
            </div>
        </div>
    </div>

    <!-- Inscrits cette année -->
    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 py-2">
            <div class="card-body d-flex flex-column align-items-center p-2">
                <div class="text-success mb-2">
                    <i class="fas fa-user-check fa-4x"></i>
                </div>
                <h1 class="fw-bold text-dark mb-1">{{ $inscription ?? 0 }} </h1>
                <p class="text-muted mb-0">Inscrits ({{ session('annee') ?? '' }})</p>
            </div>
        </div>
    </div>

    <!-- Nombre de classes -->
    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 py-2">
            <div class="card-body d-flex flex-column align-items-center p-2">
                <div class="text-warning mb-2">
                    <i class="fas fa-chalkboard-teacher fa-4x"></i>
                </div>
                <h1 class="fw-bold text-dark mb-1">{{ $classes ?? 0 }}</h1>
                <p class="text-muted mb-0">Classes ({{ session('annee') ?? '' }})</p>
            </div>
        </div>
    </div>
     
</div>

  </div>
</div>
<!-- Overlay -->
@if (!session()->has('annee'))
<!-- Overlay -->
<div id="overlay">
    <div class="overlay-content">
        <div class="custom-select-wrapper">
            <div class="custom-select" onclick="toggleDropdown()">
                <span id="selected-option">Sélectionner une année</span>
                <ul id="dropdown-options" class="custom-options hidden">
                    <li onclick="selectOption('2021-2022')">2021-2022</li>
                    <li onclick="selectOption('2022-2023')">2022-2023</li>
                    <li onclick="selectOption('2023-2024')">2023-2024</li>
                    <li onclick="selectOption('2024-2025')">2024-2025</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        backdrop-filter: blur(8px);
        background-color: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .overlay-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
    }

    .custom-select-wrapper {
        position: relative;
        width: 250px;
        font-family: sans-serif;
    }

    .custom-select {
        background: #f0f0f0;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }

    .custom-options {
        list-style: none;
        padding: 0;
        margin: 0;
        background: white;
        border: 1px solid #ccc;
        border-top: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        z-index: 10000;
    }

    .custom-options li {
        padding: 10px;
        cursor: pointer;
    }

    .custom-options li:hover {
        background: #f1f1f1;
    }

    .hidden {
        display: none;
    }
</style>

<script>
    function toggleDropdown() {
        document.getElementById('dropdown-options').classList.toggle('hidden');
    }

    function selectOption(value) {
        document.getElementById('selected-option').textContent = value;
        document.getElementById('dropdown-options').classList.add('hidden');
        // Tu peux déclencher ici une action JS
        document.getElementById('overlay').style.display="none";

        fetch('/set-annee-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ annee: value })
        })
        .then(response => response.json())
        .then(data => {

            location.reload(); 
        })
        .catch(error => {
            console.error("Erreur:", error);
        });
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.querySelector('.custom-select');
        if (!dropdown.contains(e.target)) {
            document.getElementById('dropdown-options').classList.add('hidden');
            document.getElementById('overlay').classList.add('hidden');
        }
    });
</script>


@if(session('mil'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        html: `{!! session('mil') !!}`,
        width: 600,
        confirmButtonText: 'OK',
        customClass: {
            popup: 'shadow-lg rounded-4'
        }
    });
});
</script>
@endif
@endsection