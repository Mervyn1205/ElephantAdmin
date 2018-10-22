layui.use('form', function(){
    var form = layui.form;
    form.verify({
        /**
         * 判断表单元素的最大值
         * value：表单的值、item：表单的DOM对象
         * 需要新增  verify-max 属性来控制表单元素允许的最大值，默认为25
         */
        max: function(value, item){
            var maxLen = item.getAttribute('verify-max') ? item.getAttribute('verify-max') : 25;
            if (value.length > maxLen) {
                return "最多" + maxLen + "个字符";
            }
        },

        /**
         * 判断表单元素的最小值
         * value：表单的值、item：表单的DOM对象
         * 需要新增  verify-min 属性来控制表单元素允许的最小值，默认为1
         */
        min: function(value, item){
            var minLen = item.getAttribute('verify-min') ? item.getAttribute('verify-min') : 1;
            if (value.length < minLen) {
                return "最少" + minLen + "个字符";
            }
        }
    });
});
