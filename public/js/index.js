function getDataFromController(url){
    let ajaxUrl = url
    let js;
    if(url.includes("?")){
        js = '&js=1'
    }
    else js = '?js=1'
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: ajaxUrl + js,
            type: 'GET',
            dataType: 'json',
            async: true,
            success: function(data) {
                resolve(data)
            },
            error: function(err) {
                reject(err)
            }
        });
    }).then(function(data) {
        return data;
    }).catch(function(err) {
        console.log(err)
    })
}