<div class="col-12">
    <h2 class="title-md bold color-dark">Rapports de bugs</h2>
</div>


<div class="col-12 mr-top">
    <canvas id="line-chart" height="100"></canvas>
</div>

<script>
    new Chart(document.getElementById("line-chart"), {
    type: 'bar',
    data: {
        labels: ['Il y a 7 jours', 'Il y a 6 jours', 'Il y a 5 jours', 'Il y a 4 jours', 'Avant-Hier', 'Hier', 'Aujourd\'hui'],
        datasets: [{ 
            data: [<?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 6) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 5) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 4) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 3) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 2) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 1) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'undefined', 0) ;?>],
            label: "Non défini",
            borderColor: "rgba(156,54,181, 0.8)",
            backgroundColor: "rgba(156,54,181, 0.7)",
        }, { 
            data: [<?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 6) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 5) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 4) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 3) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 2) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 0) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'working', 0) ;?>],
            label: "En cours",
            borderColor: "rgba(217,72,15, 0.8)",
            backgroundColor: "rgba(217,72,15, 0.7)",
        }, { 
            data: [<?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 6) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 5) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 4) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 3) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 2) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 0) ;?>, <?= $bug -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 0) ;?>],
            label: "Terminé",
            borderColor: "43,138,62, 0.8)",
            backgroundColor: "rgba(43,138,62, 0.7)",
        }
        ]
    },
    options: {
        title: {
        display: true,
        text: 'Actions effectuées sur les rapports de bugs'
        }
    }
    });

</script>