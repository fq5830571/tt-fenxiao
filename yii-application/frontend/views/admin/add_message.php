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
<div class="layui-tab page-content-wrap">
    <ul class="layui-tab-title">
        <li class="layui-this">添加信息</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" style="width: 90%;padding-top: 20px;" onclick="return false">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">消息内容：</label>
                    <div class="layui-input-block">
                        <textarea id="content" placeholder="请输入内容" class="layui-textarea"><?=$message['content']?$message['content']:''?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal sure" lay-submit="" lay-filter="adminInfo">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".sure").click(function(){
        var id ='<?=$message['id']?$message['id']:0?>';
        $.ajax({
            type: "post",
            url: "/index.php?r=admin/add-message",
            data: {id:id,content:$("#content").val()},
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