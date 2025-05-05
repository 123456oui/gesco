
document.addEventListener('DOMContentLoaded', function () {
    // Initialisation de la carte
    const map = L.map('map').setView([12.3657, -1.5339], 7); // Coordonnées initiales

    // Ajouter une couche de tuiles (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ajouter des marqueurs pour chaque point
    points.forEach(point => {
        const marker = L.marker([point.lat, point.lng]).addTo(map);
        marker.bindPopup(`<b>${point.name}</b>`); // Ajouter un popup pour chaque marqueur
    });

   
});

function populateniveau(datas,element ) {
    const selectClasses = document.getElementById(element);
    selectClasses.innerHTML = ''; // Effacer les options existantes
    var text="";
    if(element==="niveau"){
        text='sélectionner un niveau';
    }
    if(element==="classe"){
        text='sélectionner une classse';
    } 
    // Ajouter une première option par défaut
    const defaultOption = document.createElement('option');
    defaultOption.value = ''; // Pas de valeur
    defaultOption.textContent = text ; // Texte de l'option par défaut
    defaultOption.selected = true; // Sélectionner cette option par défaut
    defaultOption.disabled = true; // Désactiver pour obliger un choix
    selectClasses.appendChild(defaultOption);

    // Ajouter les options des pratiques
    for (const key in datas){
        const option = document.createElement('option');
        option.value = key;
        option.textContent = datas[key];
        selectClasses.appendChild(option);
    }
}

function showSelection(selectElement) 
{
    $('#classe').val('');
    reinitialiser();
    const cycleId = selectElement.value; // Récupérer la valeur sélectionnée
    // Construire l'URL de l'API avec les paramètres

    const url = `/cyclebyId/${rub}/${srub}?cycleId=${cycleId}`;
    // Effectuer la requête fetch
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur réseau: ${response.status} - ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
               var niv = [];
                data.niveaux.forEach(item => {
                    niv[item.id] =item.libelleniveau;
                });
                var niveau="niveau";
                populateniveau(niv,niveau);
            } else {
                console.error('Erreur dans la réponse:', data.message);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
}

function showclasse(selectElement) 
{
    reinitialiser();
    const niveauId = selectElement.value; // Récupérer la valeur sélectionnée
    // Construire l'URL de l'API avec les paramètres
    matricule(niveauId);
    
    const url = `/niveaubyid/${rub}/${srub}?niveauId=${niveauId}`;
    // Effectuer la requête fetch
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur réseau: ${response.status} - ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
               var classe = [];
                data.classes.forEach(item => {
                    classe[item.id] =item.libelleclasse;
                });
                var niveau="classe";
                populateniveau(classe,niveau);
            } else {
                console.error('Erreur dans la réponse:', data.message);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
}

function getClasse(classe_id) {
    $.ajax({
        url: `/max/${classe_id}`, // Assurez-vous que cette route existe dans Laravel
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.classe<=0){
                alert("⚠️ Il n'y a plus de place disponible dans cette classe !");
                location.reload();
            }
            else{
            const rest = document.getElementById('rest');
            rest.textContent = response.classe;
            const divrest = document.getElementById('divrest');
            divrest.style.display = 'flex';
            }

            // Vous pouvez aussi manipuler la réponse ici selon vos besoins
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération de la classe :', error);
        }
    });
}

function max( selected){
   const  classe_id=selected.value;
   getClasse(classe_id);
}

function reinitialiser(){
    const divrest = document.getElementById('divrest');
    divrest.style.display = 'none';
    $('#matriculeE').val('');

}

reinitialiser();
