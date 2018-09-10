<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>上传凭证</title>
    <link rel="stylesheet" type="text/css" href="/layui-v2.2.5/layui/css/layui.css" />
    <link href="/Public/Static/css/foods.css?t=333" rel="stylesheet" type="text/css">
</head>
<body>
<div>
    <ul class="round" style="margin:0;padding:0;border-radius:0;border:0px;border-bottom:1px solid #C6C6C6">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
            <tbody>
            <tr>
                <td><span>上传凭证</span> <span style="float:right"></span>
                </td>
            </tr>
            </tbody>
        </table>
    </ul>
</div>
<form class="layui-form" action="index.php?r=member/upload" method="post" id="shop" enctype="multipart/form-data">
<div class="layui-form-item" style="    margin-left: 110px;
    min-height: 36px;
    padding-top: 20px;">
    <img src=""  width="113px" height="100px" id="img" style="display: none"/>
<button type="button" class="layui-btn" id="test1">
    <i class="layui-icon">&#xe67c;</i>上传凭证
</button>
    <input type="hidden" name="order_id" value="<?=$order_id?>" />
    <input type="hidden" name="image" value="" id="shoplogo"/>
</div>
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">说明</label>
    <div class="layui-input-block">
        <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
</div>
<div class="layui-form-item">

    <div class="layui-input-block">
        <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
    </div>
</div>
</form>
<script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
<script src="/layui-v2.2.5/layui/ajaxfrom.js" type="text/javascript" charset="utf-8"></script>
<script src="/layui-v2.2.5/layui/layui.js" type="text/javascript" charset="utf-8"></script>

<script>
    layui.use('form', function(){
        var form = layui.form;
        $('#shop').ajaxForm(function(data) {
            layer.alert(data.msg);
            if (data.status == 1)
            {
                setTimeout(function () {
                    location.href="/index.php?r=member/order";
                },1000)
            }
        });
    });
    layui.use(['upload','layer'], function(){
        var $ = layui.$;
        var upload = layui.upload;
        var layer = layui.layer;
        //执行实例
        var logouploadInst = upload.render({
            elem: '#test1' //绑定元素
            ,url:'/index.php?r=shop/test'
            ,auto: false//选择文件后不自动上传
            ,bindAction: '#testListAction'//指向一个按钮触发上传
            ,exts:'jpg|png|jpeg'
            ,choose: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#img').attr('src',result);
                    $('#img').css('display','block');
                    $('#shoplogo').val(result);
                });
            }
        });
    });
</script>
</body>
</html>