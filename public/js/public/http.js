layui.define(['jquery'], function (exports) {
    var $ = layui.$;

    exports('http', {
        code_not_login: 4000,
        get: function(url, data, callback, dataType) {
            data = data || {};
            callback = callback || function(res){console.log(res);};
            dataType = dataType || 'json';
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                success: callback,
                error:function(res) {
                    console.log(res);
                },
                dataType: dataType
            });
        },

        post: function(url, data, dataType = 'json', callback, error_callback) {
            data           = data || {};
            callback       = callback || function(res){console.log(res);};
            error_callback = error_callback || function(res){console.log(res);};
            dataType       = dataType || 'json';
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: callback,
                error:error_callback,
                dataType: dataType
            });
        }
    });
});