
<p>Prénom <span id="firstname"></span></p>
<p>Nom <span id="lastname"></span></p>
<p>Email <span id="email"></span></p>

<script>
    $(document).ready(function () {
        async function printData() {
            const data = await getDataFromController('profile');
            /*début du remplissage de la page*/
            console.log(data);
        }
        printData();
    });
</script>
