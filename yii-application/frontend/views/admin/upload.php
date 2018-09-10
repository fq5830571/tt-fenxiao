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
    <img src="<?=$proof['image']?>"  width="225px" height="200px" id="img" />
    <input type="hidden" name="image" value="" id="shoplogo"/>
</div>
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">说明</label>
    <div class="layui-input-block">
        <textarea disabled="disabled" name="content" placeholder="请输入内容" class="layui-textarea"><?=$proof['content']?></textarea>
    </div>
</div>

</form>
<script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
<script src="/layui-v2.2.5/layui/ajaxfrom.js" type="text/javascript" charset="utf-8"></script>
<script src="/layui-v2.2.5/layui/layui.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>