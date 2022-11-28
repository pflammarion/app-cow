<div class="profil">
    <div class="container">
        <h2 id="name"></h2>
        <img class="profil-img" id="img">
        <p id="username"></p>
        <div class="profil-mail">
            <img src="./public/assets/icon/sendMail.svg" alt="email">
            <p id="email"></p>
        </div>
        <button>Modifier</button>
        <div class="profil-footer">
            <button class="">Supprimer</button>
            <p>Rôle : <span id="role"></span></p>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        async function printData() {
            const data = await getDataFromController('profile');
            console.log(data);
            const name = data['firstname'] + " " + data['lastname'];
            $('#name').text(name);
            $('#img').attr('src', data['img_url']);
            $('#username').text(data['username']);
            $('#email').text(data['email']);
            $('#role').text(data['role'])
        }
        printData();
    });
</script>
