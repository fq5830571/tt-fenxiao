<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>用户管理</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
    <script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
    <script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>
</head>
    <form class="layui-form" onclick="return false">
    <div class="layui-form-item">
        <div class="layui-inline tool-btn">
            <button class="layui-btn layui-btn-small layui-btn-normal addBtn hidden-xs" data-url="menu-add2.html"><i
                        class="layui-icon"></i></button>
            <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn hidden-xs"
                    data-url="/admin/category/listorderall.html"><i class="iconfont"></i></button>
        </div>
        <div class="layui-inline">
            <select id="level" lay-filter="status">
                <?php foreach ($levelList as $key=>$value){?>
                    <option value="<?=$key?>"><?=$value?></option>
                <?php }?>
            </select>
            <div class="layui-unselect layui-form-select">
                <div class="layui-select-title"><input type="text" placeholder="选择等级" value="选择等级" readonly=""
                                                       class="layui-input layui-unselect"><i class="layui-edge"></i>
                </div>
                <dl class="layui-anim layui-anim-upbit">
                    <?php foreach ($levelList as $key=>$value){?>
                        <dd lay-value="<?=$key?>" class=""><?=$value?></dd>
                    <?php }?>
                </dl>
            </div>
        </div>
        <input type="hidden" id="id" value="<?=$id?>"/>
        <button class="layui-btn layui-btn-normal sure" >确定</button>
    </div>
    </form>
  <script>
    $(".sure").click(function(){
        $.ajax({
            type: "post",
            url: "/index.php?r=admin/set-level",
            data: {id:$("#id").val(), level:$("#level").val()},
            dataType: "json",
            success: function(data){
                layer.msg(data.msg);
                if(data.code == 200){
                    window.parent.location.reload();
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                }
            }
        });
    })
</script>