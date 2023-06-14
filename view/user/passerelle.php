<?php
$data_trame = $data_trame ?? [];
?>

<div class="passerelle">
    <div class="table">
        <div class="container" style="padding: 20px">
            <label for="rating">Taux de rafraichissement</label>
            <select name="rating" id="refresh-rate">
                <option value="60000" selected="selected">Min</option>
                <option value="1000">Sec</option>
            </select>
            <div id="table-content" class="table-content">
                <canvas id="graph1"></canvas>
            </div>
        </div>
        <div class="container" style="padding: 20px; margin: 20px">
            <div id="table-content" class="table-content">
                <canvas id="graph2"></canvas>
            </div>
        </div>
        <div class="container" style="padding: 20px">
            <div id="table-content" class="table-content">
                <canvas id="graph3"></canvas>
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
        width: 50px;
    }
</style>

<script>
    $(document).ready(() => {
        let dataFiltered1 = [];
        let labelFiltered1 = [];

        let dataFiltered2 = [];
        let labelFiltered2 = [];

        let dataFiltered3 = [];
        let labelFiltered3 = [];

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

            // Filter data for Sensor 1
            let dataFiltered1 = [];
            let labelFiltered1 = [];
            let sensor1Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 5 &&
                    item.log_valeur < 100 &&
                    item.log_valeur > 20
            );
            for (let i = 0; i < sensor1Data.length; i++) {
                dataFiltered1.push(sensor1Data[i].log_valeur);
                labelFiltered1.push(sensor1Data[i].log_date);
            }

            // Filter data for Sensor 2
            let dataFiltered2 = [];
            let labelFiltered2 = [];
            let sensor2Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 6 &&
                    item.log_valeur < 100 &&
                    item.log_valeur > 20
            );
            for (let i = 0; i < sensor2Data.length; i++) {
                dataFiltered2.push(sensor2Data[i].log_valeur);
                labelFiltered2.push(sensor2Data[i].log_date);
            }

            // Filter data for Sensor 3
            let dataFiltered3 = [];
            let labelFiltered3 = [];
            let sensor3Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 7 &&
                    item.log_valeur < 100 &&
                    item.log_valeur > 20
            );
            for (let i = 0; i < sensor3Data.length; i++) {
                dataFiltered3.push(sensor3Data[i].log_valeur);
                labelFiltered3.push(sensor3Data[i].log_date);
            }

            console.log(dataFiltered1);
            console.log(dataFiltered2);
            console.log(dataFiltered3);

            mixedChart1.data.datasets[0].data = dataFiltered1;
            mixedChart1.data.labels = labelFiltered1;
            mixedChart1.update();

            mixedChart2.data.datasets[0].data = dataFiltered2;
            mixedChart2.data.labels = labelFiltered2;
            mixedChart2.update();

            mixedChart3.data.datasets[0].data = dataFiltered3;
            mixedChart3.data.labels = labelFiltered3;
            mixedChart3.update();
        };

        let ctx1 = $('#graph1');
        let ctx2 = $('#graph2');
        let ctx3 = $('#graph3');

        const mixedChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                datasets: [{
                    data: dataFiltered1,
                    borderColor: '#ADE194',
                    backgroundColor: '#ADE194',
                    lineTension: 0.4,
                    label: 'Valeur',
                }],
                labels: labelFiltered1,
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Microphone',
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

        const mixedChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                datasets: [{
                    data: dataFiltered2,
                    borderColor: '#94b5e1',
                    backgroundColor: '#94a1e1',
                    lineTension: 0.4,
                    label: 'Valeur',
                }],
                labels: labelFiltered2,
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Humidité',
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
                            text: '%',
                        },
                    },
                },
            },
        });

        const mixedChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                datasets: [{
                    data: dataFiltered3,
                    borderColor: '#ce94e1',
                    backgroundColor: '#dc94e1',
                    lineTension: 0.4,
                    label: 'Valeur',
                }],
                labels: labelFiltered3,
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Température',
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
                            text: '°C',
                        },
                    },
                },
            },
        });

        // Call updateGraph initially
        updateGraph();

        // Start the initial interval
        intervalId = setInterval(updateGraph, interval);
    });
</script>


