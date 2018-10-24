layui.use(['element', 'jquery', 'http', 'layer'], function(){
    var element = layui.element;
    var http = layui.http;
    var $ = layui.$;

    var index = {
        handleClickTopMenu:function(){
            $("#header-nav a").on('click', function(){
                $('#header-nav').find('li').removeClass('layui-this');
                $(this).parent().addClass('layui-this');

                var moduleId = $(this).attr("data-module-id");
                http.get('/menu/'+moduleId, {}, $this.renderLeftNav);

                return false;
            });
        },

        renderLeftNav: function(res){
            var menu = res.data;
            var leftNavDom = $("#left-nav");
            leftNavDom.html('');
            var navStr = "";
            for (var menuIndex in menu) {
                navStr += '<li class="layui-nav-item layui-nav-itemed">';

                var aClass = menu[menuIndex].is_active && !menu[menuIndex].child ? 'layui-this' : '';
                navStr += '<a class="' + aClass + '" href="' + menu[menuIndex].url + '">'+ menu[menuIndex].name +'</a>';
                if (menu[menuIndex].child && menu[menuIndex].child.length > 0) {
                    var child = menu[menuIndex].child;
                    navStr += '<dl class="layui-nav-child">';
                    var ddClass = '';
                    for(var index in child) {
                        ddClass = child[index].is_active ? 'layui-this' : '';
                        navStr += '<dd class="' + ddClass + '"><a href="' + child[index].url + '">'+ child[index].name +'</a></dd>';
                    }
                    navStr += '</dl>';
                }
                navStr += '</li>';
            }

            leftNavDom.html(navStr);
            element.render('nav');
        },

        //处理点击导航
        handleClickLeftMenu: function () {
            $("#sidebar").on('click', function(){
                return false;
            });

            var iframeDom = $("#iframe");
            element.on('nav(left-nav)', function (elem) {
                var index = layer.load();
                var href = '';
                if (elem.attr("href")) {
                    href = elem.attr("href");
                }
                iframeDom.attr("src", href);
                iframeDom.load(function(){
                    layer.close(index);
                });

            });
        },

        init: function () {
            $this = this;
            this.handleClickTopMenu();
            this.handleClickLeftMenu();
        }
    };

    index.init();
});