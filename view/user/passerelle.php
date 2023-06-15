<?php
$data_trame = $data_trame ?? [];
?>

<div class="popup-container" id="popup_passerelle"  onclick="hide(this)"></div>

<div class="passerelle">
    <div class="table">
        <div class="btn-container">
            <button id="button-led-green" data-val="green" class="btn-led btn-valider">
                Allumer la led verte
            </button>

            <button id="button-led-orange" data-val="orange" class="btn-led btn-warning">
                Allumer la led orange
            </button>

            <button id="button-led-red" data-val="red" class="btn-led btn-error">
                Allumer la led rouge
            </button>

            <button id="button-led-reset" data-val="reset" class="btn-led btn-reset">
                Éteindre la led la led verte
            </button>
        </div>


        <div class="container" style="padding: 20px; margin-bottom: 20px">
            <label for="rating">Taux de rafraichissement</label>
            <select name="rating" id="refresh-rate">
                <option value="60000" selected="selected">Min</option>
                <option value="1000">Sec</option>
            </select>
            <div id="table-content" class="table-content">
                <canvas id="graph1"></canvas>
            </div>
        </div>
        <div class="container" style="padding: 20px; margin-bottom: 20px">
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

    .passerelle .btn-led{
        color: black;
        margin: 0 auto;
        padding: 5px;
        width: 200px;
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

        i = 0

        $('.btn-led').on('click', async function(){
            let trame = "";
            switch ($(this).data("val")){
                case "reset" :
                    trame = "1G05E24010000000";
                    break;
                case "green" :
                    trame = "1G05E24010001000";
                    break;
                case "orange" :
                    trame = "1G05E24010002000";
                    break;
                case "red" :
                    trame = "1G05E24010003000";
                    break;
            }
            let sendCommand = await getDataFromController('user?page=passerelle&action=post&trame=' + trame);
            //changer le bg du btn ?
            $(".popup-container").append('<div class="popup" id="number' + i + '">État de la commande envoyée à la carte : ' + sendCommand + '</div>');
            $('#number' + i).addClass('success');
            $('.popup').delay(5000).fadeOut('slow');
            i++;

        })

        const updateGraph = async () => {
            let dataPasserelle = await getDataFromController('user?page=passerelle&action=get');

            dataPasserelle.sort((a, b) => a.log_date - b.log_date);

            // Filter data for Sensor 1
            let sensor1Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 5 &&
                    item.log_valeur > 0 &&
                    item.log_valeur < 100
            );
            sensor1Data = sensor1Data.slice(-100);
            dataFiltered1 = sensor1Data.map(item => item.log_valeur);
            labelFiltered1 = sensor1Data.map(item => item.log_date);

            // Filter data for Sensor 2
            let sensor2Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 6 &&
                    item.log_valeur > 0
            );
            sensor2Data = sensor2Data.slice(-100);
            dataFiltered2 = sensor2Data.map(item => item.log_valeur);
            labelFiltered2 = sensor2Data.map(item => item.log_date);

            // Filter data for Sensor 3
            let sensor3Data = dataPasserelle.filter(
                item =>
                    item.log_capteur === 7 &&
                    item.log_valeur > 0
            );
            sensor3Data = sensor3Data.slice(-100);
            dataFiltered3 = sensor3Data.map(item => item.log_valeur);
            labelFiltered3 = sensor3Data.map(item => item.log_date);

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
    function hide(e){
        e.style.display = "none";
    }
</script>


