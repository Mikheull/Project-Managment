<div class="col-12 mr-top">
    <canvas id="line-chart" height="100"></canvas>
</div>

<script>
    new Chart(document.getElementById("line-chart"), {
    type: 'bar',
    data: {
        labels: ['Il y a 7 jours', 'Il y a 6 jours', 'Il y a 5 jours', 'Il y a 4 jours', 'Avant-Hier', 'Hier', 'Aujourd\'hui'],
        datasets: [{ 
            data: [<?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 6) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 5) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 4) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 3) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 2) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 1) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'created', 0) ;?>],
            label: "Créee",
            borderColor: "rgba(57, 65, 101, 0.8)",
            backgroundColor: "rgba(57, 65, 101, 0.7)",
        }, { 
            data: [<?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 6) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 5) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 4) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 3) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 2) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 0) ;?>, <?= $task -> getActivityPerDate($router -> getRouteParam("2"), 'ended', 0) ;?>],
            label: "Terminée",
            borderColor: "rgba(76, 108, 246, 0.8)",
            backgroundColor: "rgba(76, 108, 246, 0.7)",
        }
        ]
    },
    options: {
        title: {
        display: true,
        text: 'Actions effectuées sur les tâches'
        }
    }
    });

</script>