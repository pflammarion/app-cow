<div class="table">
    <div class="container">
        <div class="table-header">
            <img id="sensor" data-val="<?php echo intval($_GET['sensor']) ?>" src="" alt="icon">
            <div class="changer">
                <img id="arrow-down" src="./public/assets/icon/arrow.svg" alt="arrow">
                <input id="datePicker" type="date" name="date">
                <img id="arrow-up" src="./public/assets/icon/arrow.svg" alt="arrow 2">
            </div>
            <img id="average" data-val="1" src="./public/assets/icon/sorting.svg" alt="sorting">
        </div>
        <div id="table-content" data-val="<?php echo intval($_GET['cow']) ?>" class="table-content">
            <canvas id="graph"></canvas>
        </div>
    </div>
    <div class="container">
        <span>Liens de téléchargement des données :</span>
        <div class="download-link">
            <a href="user?page=tableau&api=1&exel=1&cowId=<?php echo intval(($_GET['cow']))?>" title="Vache sélectionnée"><img src="./public/assets/icon/cow_download.svg" alt="Download cow data"></a>
            <a href="user?page=tableau&api=1&exel=1" title="Tout votre troupeau"><img src="./public/assets/icon/herd_download.svg" alt="Download cow data"></a>
        </div>
        <input type="search" placeholder="Rechercher par nom ou n°">
        <div id="selected-cow">
            <!-- voir le cas ou la vache est null (empecher le lien de la page d'accueil ?) -->
            <div class="crop-img"><img src="" alt="cow"></div>
            <div class="content"></div>
        </div>
        <div id="herd"></div>
    </div>
</div>


<script>
    $(document).ready(() => {
        let average = $('#average').data("val");
        let sensor = $('#sensor').data('val');
        let cowId =  $('#table-content').data('val');
        let cowName = "";
        let title = "";
        let abscisse = "";
        let type = "";
        let cow = [];
        let herd = [];
        //change to empty date
        document.getElementById('datePicker').valueAsDate = new Date('2022-01-01');
        if (sensor ===1){
            $('#sensor').attr('src', './public/assets/icon/heart.svg')
            type = 'BPM';
        }
        if (sensor ===2){
            $('#sensor').attr('src', './public/assets/icon/air.svg')
            type = '%';
        }
        if (sensor ===3){
            $('#sensor').attr('src', './public/assets/icon/sound.svg')
            type = 'dB'
        }
        if (sensor ===4){
            $('#sensor').attr('src', './public/assets/icon/battery.svg')
            type = '%';
        }

        const getCow = async () =>{
            let selectedCow = await getDataFromController('user?page=tableau&selectedCow=' + cowId);
            let src = '';
            let name = '';
            let number = '';
            if (!selectedCow.length){
                if (selectedCow['img'] !== null && selectedCow['img'] !== "" && selectedCow['img'] !== undefined){
                    src = selectedCow['img'];
                }
                else{
                    src = './public/assets/icon/cow.svg'
                }

                if (selectedCow['name'] !== null && selectedCow['name'] !== "" && selectedCow['name'] !== undefined){
                    name = selectedCow['name'];
                }

                if (selectedCow['number'] !== null && selectedCow['number'] !== "" && selectedCow['number'] !== undefined){
                    number = 'N°' + selectedCow['number'];
                }
                else number = 'Aucune vache ne peut être sélectionnée'
                cowId = selectedCow['id'];
                $('#table-content').data('val', cowId);
                $('#selected-cow').find('img').attr('src', src);
                $('#selected-cow').find('.content').append('<span>' + name +'</span><span>' + number + '</span>')
            }
        }

        getCow();

        const getHerd = async () =>{
            $('#herd').empty()
            let url = '';
            let search = $('input[type=search]').val();
            if (search !== ""){
                url = 'user?page=tableau&herd=1&recherche=' + search;
            }
            else url = 'user?page=tableau&herd=1';

            let herd = await getDataFromController(url);
            let name = '';
            let number = '';
            if (herd.length>0){
                for (let i = 0; i< herd.length; i++){
                    if(cowId !== herd[i]['id']){
                        if (herd[i]['name'] !== null && herd[i]['name'] !== ""){
                            name = herd[i]['name'];
                        }

                        if (herd[i]['number'] !== null && herd[i]['number'] !== ""){
                            number = 'N°' + herd[i]['number'];
                        }
                        let id = herd[i]['id'];
                        //faire onclick js plutot qu'un lien mais pas grave pour l'instant
                        $('#herd').append('<a href="user?page=tableau&sensor=2&cow=' + id +'" class="herd-button"><span>' + name +'</span><span>' + number + '</span></a>')
                    }
                }
            }
        }

        getHerd();

        const getData =  async () => {
            if (sensor ===1){
                type = 'BPM';
            }
            if (sensor ===2){
                type = '%';
            }
            if (sensor ===3){
                type = 'dB'
            }
            if (sensor ===4){
                type = '%';
            }
            if ($('#average').data("val") === 2){
                title = "Données sur 7 jours";
                abscisse = "Jours";
            }
            else if ($('#average').data("val") === 3){
                title = "Données annuelles";
                abscisse = "Mois";
            }
            else{
                title = "Données journalières";
                abscisse = "Heures"
            }
            let data = await getDataFromController('user?page=tableau&average=' + average + '&sensor=' + sensor + '&cowId=' + cowId +'&date=' + $('#datePicker').val())
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
            mixedChart.options.scales.y.title.text = type;
            mixedChart.options.scales.x.title.text = abscisse;
            mixedChart.options.plugins.title.text = title;
            mixedChart.update();
        }
        getData();

        $(document).on('load', async function(){
            await getData();
            await getCow();
        })


        $('#datePicker').on('change', async function() {
            await getData();
        });

        $("input[type=search").on('input', async function(){
            await getHerd()
        })

        $('#average').on('click', async function (){
            $('#average').data("val", average + 1);
            average = $('#average').data("val");
            if (average > 3){
                average = 1;
            }
            await getData();
        });

        $('#sensor').on('click', async function (){
            $('#sensor').data("val", sensor + 1);
            sensor = $('#sensor').data("val");
            if (sensor > 4){
                sensor = 1;
            }
            if (sensor ===1){
                $('#sensor').attr('src', './public/assets/icon/heart.svg')
            }
            if (sensor ===2){
                $('#sensor').attr('src', './public/assets/icon/air.svg')
            }
            if (sensor ===3){
                $('#sensor').attr('src', './public/assets/icon/sound.svg')
            }
            if (sensor ===4){
                $('#sensor').attr('src', './public/assets/icon/battery.svg')
            }
            await getData();
        });

        let number;
        $('#arrow-down').on('click', async function(){
            if ($('#average').data("val") === 2){
                number = 7
            }
            else if ($('#average').data("val") === 3){
                number = 365
            }
            else number = 1;
            const currentDate = new Date($('#datePicker').val());
            currentDate.setDate(currentDate.getDate() - number);
            document.getElementById('datePicker').valueAsDate = new Date(currentDate);
            await getData();
        })

        $('#arrow-up').on('click', async function(){
            if ($('#average').data("val") === 2){
                number = 7
            }
            else if ($('#average').data("val") === 3){
                number = 365
            }
            else number = 1;
            const currentDate = new Date($('#datePicker').val());
            currentDate.setDate(currentDate.getDate() + number);
            document.getElementById('datePicker').valueAsDate = new Date(currentDate);
            await getData();
        })

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
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: title,
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
                                text: type,
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: abscisse,
                            }
                        }
                    }

                },
            });
    });
</script>