<div class="col-12">
    <h2 class="title-md bold color-dark">Tâches</h2>
</div>


<div class="col-12 margin-top">
    <canvas id="line-chart" height="100"></canvas>

</div>

<script>
    new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
        labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
        datasets: [{ 
            data: [86,114,106,106,107,111,133,221,783,2478],
            label: "Créee",
            borderColor: "#4C6CF6",
            fill: true,
            backgroundColor: "#4c6bf623",
        }, { 
            data: [282,350,411,502,635,809,947,1402,3700,5267],
            label: "Terminée",
            borderColor: "#f55050",
            fill: true,
            backgroundColor: "#f5505034",
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