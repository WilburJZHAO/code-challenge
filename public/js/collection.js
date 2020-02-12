function delCollection(){
    layer.confirm('您是如何看待前端开发？', {
        btn: ['重要','奇葩'] //按钮
    }, function(){
        layer.msg('的确很重要', {icon: 1});
    }, function(){
        layer.msg('也可以这样', {
            time: 20000, //20s后自动关闭
            btn: ['明白了', '知道了']
        });
    });
}

function aa(){
    layer.photos({
        photos: json/选择器,
        tab: function(pic, layero){
            console.log(pic) //当前图片的一些信息
        }
    });
}