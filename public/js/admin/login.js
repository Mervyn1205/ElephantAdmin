layui.use(['form', 'http'], function(){
    var form = layui.form;
    var http = layui.http;

    var login = {
        handleLogin: function() {
            var isSubmit = false;
            form.on('submit(login)', function(data){
                if (isSubmit) {
                    return false;
                }
                isSubmit = true;
                http.post('/login', data.field, 'json', function(res){
                    if (res.code != 0) {
                        layer.msg(res.msg);
                        isSubmit = false;
                        return false;
                    } else {
                        layer.msg("登陆成功");
                    }
                    window.location.href = res.data.homePage;
                });

                return false;
            });
        },
        init: function () {
            $this = this;
            this.handleLogin();
        }
    };

    login.init();
});