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
        let ctx = $('#graph');
        let dataPasserelle = <?php echo json_encode($data_trame) ?>;
        let dataFiltered = []
        for(let i = 0; i < dataPasserelle.length; i++){
            if (dataPasserelle[i]["log_capteur"] == 5){
                dataFiltered.push(dataPasserelle[i]["log_valeur"])
            }
        }
            const mixedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        data: [20, 10],
                    }],
                    labels: ['a', 'b']
                }
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: "test",
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
        });

</script>

