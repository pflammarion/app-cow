function getDataFromController(controller){
    jQuery.extend({
        getValues: function(url) {
            let result = null;
            $.ajax({
                url : url,
                type : 'GET',
                dataType : 'json',
                async: true,
                success: function(data) {
                    result = data;
                }

            })
            return result;
        }
    });

    return  $.getValues(controller + '?js=1');
}