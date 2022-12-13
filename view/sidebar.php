
<div class="back-1 sidebar">
    <div class="back-2">
        <div class="hamburger"><button>
                <img src="./public/assets/icon/sidebar.svg">
            </button>
            <span>&nbsp;&#8739;&nbsp;</span>
            <span> Titrepage</span>
        </div>
    </div>
    <div class="menu-hamburger">
        <div class="hamburger-li">
            <li>fdafafaffaf</li>
            <li>fafafaffaf</li>
            <li>fafafaffaf</li>
            <li>fafafaff</li>
        </div>
        <div class="closer">
            <p>
                <img src="./public/assets/icon/double_arrow.svg">
                Fermer le Volet</p>
        </div>
    </div>
    <div class="open">
        <img src="./public/assets/icon/double_arrow.svg">
    </div>
</div>

<script>

    const hamburger_button=document.querySelector(".hamburger button");
    let hamburger_li=document.querySelectorAll(".hamburger-li");
    let hamburger_li_li=document.querySelectorAll(".hamburger-li li");
    let hamburger=document.getElementsByClassName("hamburger");

    //HAMBUGER EMNU
    hamburger_button.setAttribute("Ouvert",1);

    hamburger_button.addEventListener("click",()=>{
        if(hamburger_button.hasAttribute("Ouvert",1) && window.innerWidth<800){
            hamburger_li[0].setAttribute("style",";display:flex;width:100px;flex-direction:column;height:110px;margin-left:16px;background-color:#C8EFFE;border-radius:5px;box-shadow:2px 2px #C9EAFE;");
            hamburger_button.setAttribute("style","background-color:#C8EFFE;transform:rotate(90deg);transition:0.25s ease;border:none;font-size:10px;cursor:pointer;font-weight:700;padding:3px;border-radius:2px;font-family:sans-serif;");
            hamburger_button.removeAttribute("Ouvert");
            hamburger_li_li.forEach(a=>{a.addEventListener("mouseenter",function handleClick(event){
                for(i=0;i<hamburger_li_li.length;i++){
                    if(window.innerWidth<800){
                        hamburger_li_li[i].setAttribute("style","background-color:#C8EFFE;border-radius:2px;padding:3px 0px 3px 6px;cursor:pointer;font-family:sans-serif;");
                        a.setAttribute("style","background-color:white;color:#C8EFFE;border-radius:2px;padding:3px 0px 3px 6px;cursor:pointer;font-family:sans-serif;");
                    }}})})}
        else{
            hamburger_li[0].setAttribute("style",";width:0;display:none;transition:1s ease");
            hamburger_button.setAttribute("style","background-color:#C8EFFE;transform:rotate(0deg);transition:0.25s ease;border:none;font-size:10px;cursor:pointer;font-weight:700;padding:3px;border-radius:2px;font-family:sans-serif;margin-top:2px");
            hamburger_button.setAttribute("Ouvert",1);
        }
    })

    //fermer en cliquant partout =>CLIsckpage if attributex exist => closer
    window.onclick = function (eventclick) {
        if (eventclick.target.contains(hamburger_li[0]) && eventclick.target !== hamburger_li[0] && window.innerWidth<800) {
            hamburger_button.setAttribute("Ouvert",1);
            hamburger_button.setAttribute("style","background-color:#C8EFFE;transform:rotate(0deg);transition:0.25s ease;font-size:10px;border:none;cursor:pointer;font-weight:700;padding:3px;border-radius:2px;font-family:sans-serif;margin-top:2px")
            hamburger_li[0].setAttribute("style","display:none;width:0px;");}}

    //SelectLargeCLick
    hamburger_li_li.forEach(b=>{b.addEventListener("click",function handleClick(){
        if(window.innerWidth>800){
            for(i=0;i<hamburger_li_li.length;i++){
                hamburger_li_li[i].setAttribute("style","background-color:#DFF6FD;border-radius:4px;cursor:pointer;padding:5px;font-family:sans-serif;");
                b.setAttribute("style","background-color:#C8EFFE;border-radius:4px;cursor:auto;padding:5px;font-family:sans-serif;");
                if(window.innerWidth>1200){hamburger_li_li[i].setAttribute("style","background-color:#DFF6FD;border-radius:4px;cursor:pointer;padding:5px;font-family:sans-serif;font-size:20px");
                    b.setAttribute("style","background-color:#C8EFFE;border-radius:4px;cursor:auto;padding:5px;font-family:sans-serif;font-size:20px");}
            }

        }})})

    //fermerVOLET
    var menu_hamburger=document.getElementsByClassName("menu-hamburger");
    const open=document.getElementsByClassName("open");
    const button_volet=document.getElementsByClassName("panel");
    button_volet[0].addEventListener("click",()=>{
        menu_hamburger[0].setAttribute("style","height:0;transition:0.5s ease;overflow:hidden;opacity:0;");
        setTimeout(() => {open[0].setAttribute("style","display:flex;padding:15px 20px 20px 20px;background-color:#C8EFFE;border-radius:50% 50% 0 0;width:0px;height:0px;justify-content:center;align-items:center;margin-left:93%;overflow:hidden;transform:rotate(180deg);")},500)
    })
    //ouvrirVolet
    open[0].addEventListener("click",()=>{
        open[0].setAttribute("style","display:none;");
        menu_hamburger[0].setAttribute("style","display:flex;flex-direction:row;height:64px;width:100%;background-color:#DFF6FD;align-items:center;justify-content:space-between;transition:0.5s ease");})

    //CSS et RESponsive

    var back_1=document.getElementsByClassName("back-1");
    var back_2=document.getElementsByClassName("back-2");
    var hamburger_span=document.querySelectorAll(".hamburger span");
    document.body.setAttribute("style","margin:0;padding:0;text-decoration:none;box-sizing:border-box;list-style:none;");


    var mqls = [window.matchMedia("(max-width: 799px)"),
        window.matchMedia("(min-width: 800px)"),
        window.matchMedia("(max-width:1199px)"),
        window.matchMedia("(min-width: 1200px)"),]

    function mediaqueryresponse(mql){
        if(mqls[3].matches){
            open[0].setAttribute("style","display:none;");
            back_2[0].setAttribute("style","display:none");
            back_1[0].setAttribute("style","height:auto;width:auto;background-color:transparent;");
            menu_hamburger[0].setAttribute("style","display:flex;flex-direction:row;height:64px;width:100%;background-color:#DFF6FD;align-items:center;justify-content:space-between");
            hamburger_li[0].setAttribute("style","display:flex;flex-direction:row;margin-left:32px;gap:16px;align-items:center;height:64px;width:auto;background-color:#DFF6FD;box-shadow:none");
            button_volet[0].setAttribute("style","display:flex;margin-right:32px;cursor:pointer;font-family:sans-serif;font-size:20px");
            for(i=0;i<hamburger_li_li.length;i++){hamburger_li_li[i].setAttribute("style","padding:5px;cursor:pointer;font-family:sans-serif;font-size:20px");}}
        if(mqls[1].matches && mqls[2].matches){
            open[0].setAttribute("style","display:none;");
            back_2[0].setAttribute("style","display:none");
            back_1[0].setAttribute("style","height:auto;width:auto;background-color:transparent;");
            menu_hamburger[0].setAttribute("style","display:flex;flex-direction:row;height:64px;width:100%;background-color:#DFF6FD;align-items:center;justify-content:space-between");
            hamburger_li[0].setAttribute("style","display:flex;flex-direction:row;margin-left:32px;gap:16px;align-items:center;height:64px;width:auto;background-color:#DFF6FD;box-shadow:none");
            button_volet[0].setAttribute("style","display:flex;margin-right:32px;cursor:pointer;font-family:sans-serif;");
            for(i=0;i<hamburger_li_li.length;i++){hamburger_li_li[i].setAttribute("style","padding:5px;cursor:pointer;font-family:sans-serif;");}}
    }

    function mediaqueryresponse1(mql){
        if(mql.matches){
            open[0].setAttribute("style","display:none;");
            back_2[0].setAttribute("style","width:100%;height:30px;background-color:#C8EFFE;display:flex;align-items:center");
            back_1[0].setAttribute("style","width:none;height:none;background-color:transparent;overflow:visible");
            hamburger[0].setAttribute("style","display:flex;justify-content:space-evenly;align-items:center;height:13px;width:auto;font-weight:700;margin-left:16px");
            hamburger_li[0].setAttribute("style","display:none;flex-direction:column;width:0px;height:110px;margin-left:16px;background-color:#C8EFFE;border-radius:5px;box-shadow:2px 2px #C9EAFE;")
            for(i=0;i<hamburger_li_li.length;i++){hamburger_li_li[i].setAttribute("style","padding:3px 0px 3px 6px;cursor:pointer;font-family:sans-serif;");};
            button_volet[0].setAttribute("style","display:none");
            menu_hamburger[0].setAttribute("style","height:auto;width:auto;overflow:hidden;");
            hamburger_button.setAttribute("Ouvert",1);
            hamburger_button.setAttribute("style","background-color:#C8EFFE;border:none;font-size:10px;cursor:pointer;font-weight:700;padding:3px;border-radius:2px;font-family:sans-serif;margin-top:2px");
            hamburger_span[0].setAttribute("style","font-size:10px;margin-top:-1px");hamburger_span[1].setAttribute("style","font-size:10px;font-family:sans-serif;");};
    }

    mediaqueryresponse1(mqls[0]);
    mediaqueryresponse(mqls[1]);
    mediaqueryresponse(mqls[2]);
    mediaqueryresponse(mqls[3]);
    mqls[0].addListener(mediaqueryresponse1) ;
    mqls[1].addListener(mediaqueryresponse) ;
    mqls[2].addListener(mediaqueryresponse) ;
    mqls[3].addListener(mediaqueryresponse) ;

</script>