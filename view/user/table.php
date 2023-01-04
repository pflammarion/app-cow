<div class="table">
    <div class="container">
        <div class="table-header">
            <img src="./public/assets/icon/heart.svg" alt="icon">
            <div class="changer">
                <img src="./public/assets/icon/arrow.svg" alt="arrow">
                <input id="datePicker" type="date" name="date">
                <img src="./public/assets/icon/arrow.svg" alt="arrow 2">
            </div>
            <img src="./public/assets/icon/sorting.svg" alt="sorting">
        </div>
        <div class="table-content">
            <canvas id="graph"></canvas>
        </div>
    </div>
</div>


<script>
    $(document).ready(() => {

        let cowName = "";
        let cow = [0, 0, 0, 0, 0, 0];
        let herd = [0, 0, 0, 0, 0, 0];
        document.getElementById('datePicker').valueAsDate = new Date('2022-01-03');
        const getData =  async () => {
            let data = await getDataFromController('user?page=tableau&type=heart&average=3&sensor=1&cowId=1&date=' + $('#datePicker').val())
            cow = [0, 0, 0, 0, 0, 0];
            herd = [0, 0, 0, 0, 0, 0];
            for (let i = 0; i < data.length; i++){
                const date = new Date(data[i]['date']);
                const month = date.getMonth();
                const index = Math.ceil(month/2)-1;
                if (data[i]['name'] !== 'herd'){
                    cow[index]= data[i]['value'];
                    cowName = data[i]['name'];
                }
            }
            mixedChart.data.datasets[1].data = cow;
            mixedChart.data.datasets[1].label = cowName;
            mixedChart.data.datasets[0].data = herd;
            mixedChart.update();
        }
        getData();

        $(document).on('load', async function(){
            await getData();
        })


        $('#datePicker').on('change', async function() {
            await getData();
        });

            let ctx = $('#graph');
            const mixedChart = new Chart(ctx, {
                data: {
                    datasets: [{
                        type: 'line',
                        label: 'Mes vaches',
                        data: herd,
                    }, {
                        type: 'bar',
                        label: cowName,
                        data: cow,
                    }],
                    labels: ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12']
                },
            });



    });
</script>