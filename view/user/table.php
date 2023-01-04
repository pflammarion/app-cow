<div class="table">
    <div class="container">
        <div class="table-header">
            <img src="./public/assets/icon/heart.svg" alt="icon">
            <div class="changer">
                <img src="./public/assets/icon/arrow.svg" alt="arrow">
                <input id="datePicker" type="date" name="date">
                <img src="./public/assets/icon/arrow.svg" alt="arrow 2">
            </div>
            <img id="average" data-val="1" src="./public/assets/icon/sorting.svg" alt="sorting">
        </div>
        <div class="table-content">
            <canvas id="graph"></canvas>
        </div>
    </div>
</div>


<script>
    $(document).ready(() => {
        let average = $('#average').data("val");
        let cowName = "";
        let cow = [];
        let herd = [];
        document.getElementById('datePicker').valueAsDate = new Date('2022-01-01');
        const getData =  async () => {
            let data = await getDataFromController('user?page=tableau&type=heart&average=' + average + '&sensor=1&cowId=1&date=' + $('#datePicker').val())
            cow = [];
            herd = [];
            let label = [];
            for (let i = 0; i < data.length; i++){
                const dateRef = new Date(data[0]['date']);
                let reference = dateRef.getDate();

                if (data[i]['name'] !== 'herd'){
                    const date = new Date(data[i]['date']);
                    let index;
                    if (average === 3){
                        const month = date.getMonth();
                        index = Math.ceil(month/2)-1;
                        label = ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12'];
                        label = label.slice(0, data.length/2);
                    }
                    if (average === 2){
                        label.push(date.getDate())
                        index = i;
                    }
                    if (average ===1){
                        label = ['0-3', '4-7', '8-11', '12-15', '16-19', '20-23'];
                        label = label.slice(0, data.length/2);
                        index = i;
                    }
                    cow[index]= data[i]['value'];
                    cowName = data[i]['name'];
                }
                if (data[i]['name'] === "herd"){
                    let index;
                    if (average === 3){
                        index = data[i]['key']-2;
                    }
                    if (average === 2){
                        index = data[i]['key'] - reference;
                    }
                    if (average === 1){
                        //pour commencer à la moitier de la liste
                        index = i - data.length/2
                    }
                    herd[index]= data[i]['value'];
                }
            }

            mixedChart.data.datasets[0].data = cow;
            mixedChart.data.datasets[0].label = cowName;
            mixedChart.data.datasets[1].data = herd;
            mixedChart.data.labels = label;
            mixedChart.update();
        }
        getData();

        $(document).on('load', async function(){
            await getData();
        })


        $('#datePicker').on('change', async function() {
            await getData();
        });

        $('#average').on('click', async function (){
            $('#average').data("val", average + 1);
            average = $('#average').data("val");
            if (average > 3){
                average = 1;
            }
            await getData();
        });

            let ctx = $('#graph');
            const mixedChart = new Chart(ctx, {
                data: {
                    datasets: [{
                        type: 'line',
                        label: cowName,
                        data: cow,
                        borderColor: '#ADE194',
                        backgroundColor: '#ADE194',
                        lineTension: 0.4,

                    }, {
                        type: 'bar',
                        label: 'Mes vaches',
                        data: herd,
                        borderColor: '#C8EFFE',
                        backgroundColor: '#C8EFFE',

                    }],
                    labels: ['1-2', '3-4', '5-6', '7-8', '9-10', '11-12']
                },
            });
    });
</script>