let result = null;
$.ajax({
    url : 'profile',
    type : 'GET',
    dataType : 'json',
    success: function(data) {
        result = data;
    }
})

console.log(result)