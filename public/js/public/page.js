layui.define(['laypage', 'url'], function (exports) {
    var $ = layui.$;

    exports('page', {
        render: function(options){
            options = options || {}
            var laypage = layui.laypage;
            var url = layui.url;
            var page = options.page || 1;
            var count = options.count || 0;
            var limit = options.limit || 10;

            laypage.render({
                elem: 'page',
                count: count,
                limit: limit,
                jump: function(obj, first){
                    if(!first){
                        location.href = url.setUrlParam(location.href, 'page', obj.curr);
                    }
                },
                curr: page,
            });
        }
    });
});