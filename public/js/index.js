function getDataFromController(url){
    let ajaxUrl = url
    let api;
    if(url.includes("?")){
        api = '&api=1'
    }
    else api = '?api=1'
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: ajaxUrl + api,
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