<div class="view-user-admin">
    <div class="view-user-header">
        <input type="search">
        <a class="btn-blue" href="admin?page=user&action=create" >
            <img class="img-black" src="./public/assets/icon/add_user_black.svg" alt="add user">
            <img class="img-white" src="./public/assets/icon/add_user_white.svg" alt="add user">
        </a>
    </div>
    <div id="user"></div>

</div>


<script>
    $(document).ready(()=>{
        const getUser = async () =>{
            $('#user').empty()
            let url = '';
            let search = $('input[type=search]').val();
            if (search !== ""){
                url = 'admin?page=user&user=1&recherche=' + search;
            }
            else url = 'admin?page=user&user=1';

            let user = await getDataFromController(url);
            if (user.length > 0){
                for (let i = 0; i< user.length; i++){
                    let html = '';
                    if(0 !== user[i]['ban']){
                        html +='<div class="user-box ban">';
                    }
                    else {
                        html += '<div class="user-box">';
                    }
                    html += '<span class="p1">id:' + user[i]['id'] +'</span>';
                    html += '<a href="admin?page=permission" class="p2">' + user[i]['role_name'] +'</a>';
                    html += '<div class="user">';
                    html +=  '<span>'+user[i]["firstname"]+'</span>';
                    html += '<span>'+user[i]["lastname"]+'</span>';
                    html += '</div>';
                    html += '<div class="email">';
                    html += '<img src="./public/assets/icon/mail.svg" alt="email" />';
                    html += '<a href="mailto:' + user[i]['email'] + '">' + user[i]['email'] + '</a>';
                    html += '</div>';
                    html += '<div class="username">';
                    html += '<img src="./public/assets/icon/user.svg" alt="user" />';
                    html += '<span>'+user[i]["username"]+'</span>';
                    html += '</div>';
                    if (user[i]['ban'] ===0){
                        html += '<div class="user-btn-box">';
                        html += '<a class="btn-blue" href="admin?page=user&action=update&id='+ user[i]['id']+'" ><img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit"><img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit"></a><a class="btn-blue" href="admin?page=user&action=delete&id='+ user[i]['id']+'" ><img class="img-black" src="./public/assets/icon/delete.svg" alt="delete"><img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete"></a>';
                        html += '</div>';
                    }
                    html += '</div>'
                    $('#user').append(html)
                }
            }
        }

        getUser();

        $("input[type=search").on('input', async function(){
            await getUser();
        })
    });
</script>

