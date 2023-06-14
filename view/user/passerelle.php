<?php
$data_trame = $data_trame ?? [];
?>

<div class="passerelle">
    <div class="table">
        <div class="container">
            <div id="table-content" class="table-content">
                <canvas id="graph"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {


        let dataFiltered = []
        let labelFiltered = []

        const getData =  async () => {

            let dataPasserelle = await getDataFromController('user?page=passerelle');

            dataFiltered = []
            labelFiltered = []

            dataPasserelle.sort((a, b) => a["log_date"] - b["log_date"]);
            for(let i = 0; i < dataPasserelle.length; i++){
                if (dataPasserelle[i]["log_capteur"] == 5 && dataPasserelle[i]["log_valeur"] < 100 && dataPasserelle[i]["log_valeur"] > 20){
                    dataFiltered.push(dataPasserelle[i]["log_valeur"])
                    labelFiltered.push(dataPasserelle[i]["log_date"])
                }
            }

            mixedChart.data.datasets[0].data = dataFiltered;
            mixedChart.data.datasets.label = labelFiltered;
            mixedChart.update();
        }


        let ctx = $('#graph');

        const mixedChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    data: dataFiltered,
                    borderColor: '#ADE194',
                    backgroundColor: '#ADE194',
                    lineTension: 0.4,
                    label: "Valeur",
                }],
                labels: labelFiltered
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: "Valeur du micro en fonction du temps",
                        font: {
                            size: 15
                        },
                        padding: {
                            bottom: 10
                        }
                    },
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: "dB",
                            }
                        },
                    }
                },
            });


        getData();

        });

</script>

