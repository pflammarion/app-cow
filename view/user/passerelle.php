<?php
$data_trame = $data_trame ?? [];
?>

<div class="passerelle">
    <div class="table">
        <div class="container" style="padding: 20px; width: 1200px; height: 600px">
            <label for="rating">Taux de rafraichissement</label>
            <select name="rating" id="refresh-rate">
                <option value="60000" selected="selected">Min</option>
                <option value="1000">Sec</option>
            </select>
            <div id="table-content" class="table-content">
                <canvas id="graph"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
    .passerelle select{
        background-color: white;
        height: 40px;
        border-radius: 5px;
        border: solid 2px var(--dark-blue);
        width: 250px;
    }
</style>

<script>
    $(document).ready(() => {
        let dataFiltered = [];
        let labelFiltered = [];

        let interval = 60000;
        let intervalId = null;

        // Event listener for the refresh rate selection
        $('#refresh-rate').on('change', function () {
            interval = Number($(this).val());

            // Clear the previous interval
            clearInterval(intervalId);

            // Start a new interval with the updated value
            intervalId = setInterval(updateGraph, interval);
        });

        const updateGraph = async () => {
            let dataPasserelle = await getDataFromController('user?page=passerelle');
            dataFiltered = [];
            labelFiltered = [];

            dataPasserelle.sort((a, b) => a.log_date - b.log_date);
            dataPasserelle = dataPasserelle.slice(-100);

            for (let i = 0; i < dataPasserelle.length; i++) {
                if (
                    dataPasserelle[i].log_capteur === 5 &&
                    dataPasserelle[i].log_valeur < 100 &&
                    dataPasserelle[i].log_valeur > 20
                ) {
                    dataFiltered.push(dataPasserelle[i].log_valeur);
                    labelFiltered.push(dataPasserelle[i].log_date);
                }
            }

            console.log(dataFiltered);

            mixedChart.data.datasets[0].data = dataFiltered;
            mixedChart.data.labels = labelFiltered;
            mixedChart.update();
        };

        let ctx = $('#graph');

        const mixedChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    data: dataFiltered,
                    borderColor: '#ADE194',
                    backgroundColor: '#ADE194',
                    lineTension: 0.4,
                    label: 'Valeur',
                }],
                labels: labelFiltered,
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Valeur du micro en fonction du temps',
                        font: {
                            size: 15,
                        },
                        padding: {
                            bottom: 10,
                        },
                    },
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'dB',
                        },
                    },
                },
            },
        });

        // Call updateGraph initially
        updateGraph();

        // Call updateGraph every second
        intervalId = setInterval(updateGraph, interval);
    });


</script>

