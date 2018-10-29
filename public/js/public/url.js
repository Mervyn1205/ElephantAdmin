layui.define(['jquery'], function (exports) {
    var $ = layui.$;

    exports('url', {
        setUrlParam: function(url, arg, val) {
            var pattern = arg+'=([^&]*)';
            var replaceText = arg+'='+val;
            return url.match(pattern) ? url.replace(eval('/('+ arg+'=)([^&]*)/gi'), replaceText) : (url.match('[\?]') ? url+'&'+replaceText : url+'?'+replaceText);
        }
    });
});