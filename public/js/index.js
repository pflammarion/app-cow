function getDataFromController(url){
    let ajaxUrl = url
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: ajaxUrl + '?js=1',
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