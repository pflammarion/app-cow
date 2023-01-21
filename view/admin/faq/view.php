<div class="view-faq-admin">
    <div class="view-faq-header">
        <input type="search" placeholder="Rechercher par titre">
            <a class="btn-blue" href="admin?page=faq&action=create" >
                <img class="img-black" src="./public/assets/icon/addquestion.svg" alt="add question">
                <img class="img-white" src="./public/assets/icon/addquestion-white.svg" alt="add question">
            </a>
    </div>
    <div id="faq"></div>
</div>


<script>
    $(document).ready(()=>{
        const getFaq = async () =>{
            $('#faq').empty()
            let url = '';
            let search = $('input[type=search]').val();
            if (search !== ""){
                url = 'admin?page=faq&faq=1&recherche=' + search;
            }
            else url = 'admin?page=faq&faq=1';

            let faq = await getDataFromController(url);
            if (faq.length > 0){
                for (let i = 0; i< faq.length; i++){
                    let html = '';
                    html += '<div class="faq-box">';
                    html += '<div class="container">';
                    html +=  '<p class="p1">id:'+faq[i]['id']+'</p>';
                    html += '<h2 class="view-faq-admin-h2">'+faq[i]['title']+'</h2>';
                    html += '<p>'+faq[i]['answer']+'</p>';
                    html += '</div>';
                    html += '<div class="faq-btn-box">';
                    html += '<a class="btn-blue" href="admin?page=faq&action=update&id='+ faq[i]['id']+'" ><img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit"><img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit"></a><a class="btn-blue" href="admin?page=faq&action=delete&id='+ faq[i]['id']+'" ><img class="img-black" src="./public/assets/icon/delete.svg" alt="delete"><img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete"></a>';
                    html += '</div>';
                    html += '</div>'
                    $('#faq').append(html)
                }
            }
        }

        getFaq();

        $("input[type=search").on('input', async function(){
            await getFaq();
        })
    });
</script>

