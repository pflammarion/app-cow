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
        const mixedChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    data: <?php echo json_encode($data_trame) ?>,
                    borderColor: '#ADE194',
                    backgroundColor: '#ADE194',
                    lineTension: 0.4,
                }],
            },
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
        mixedChart.update();
    });
</script>

