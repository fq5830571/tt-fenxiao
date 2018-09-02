<?php

/* @var $this yii\web\View */

$this->title = '用户管理';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>信息管理</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
</head>
<style>
    .blue{
    color: #1E9FFF;
    }
    .red{
    color: red;
    }
</style>
<body>
<div class="page-content-wrap">
    <!--<form class="layui-form" action="">
        <div class="layui-form-item">
            <div class="layui-inline">
                <input type="text" name="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-inline">
                <select name="states" lay-filter="status">
                    <option value="">订单状态</option>
                    <option value="0">未支付</option>
                    <option value="1">已支付</option>
                </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择一个状态" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="010" class="">正常</dd><dd lay-value="021" class="">停止</dd><dd lay-value="0571" class="">删除</dd></dl></div>
            </div>
            <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
        </div>
    </form>-->
    <button class="layui-btn layui-btn-small layui-btn-normal addBtn1 hidden-xs" data-url=""><i class="layui-icon"></i></button>
    <div class="layui-form" id="table-list">
        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <col width="100">
                <col width="100">
                <col  width="100">
                <col  width="100">
            </colgroup>
            <thead>
            <tr>
                <!--<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                <th >id</th>
                <th >信息内容</th>
                <th >状态</th>
                <th >操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($messageList as $message){?>
            <tr>
                <td class="hidden-xs"><?=$message['id']?></td>
                <td class="hidden-xs"><?=$message['content']?></td>
                <td class="hidden-xs"><button  data-id="<?=$message['id']?>" class="layui-btn layui-btn-mini table-list-status layui-btn-normal status" data-status="<?=$message['status']?>"><?=$message['status'] == 0 ?'不显示':'显示'?></button></td>
                <td class="hidden-xs"><button class="layui-btn layui-btn-mini layui-btn-normal  edit-btn1" data-id="1" data-url="menu-add2.html"><i class="layui-icon"></i></button></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        <div class="page-wrap">
            <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
        </div>
    </div>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form', 'jquery', 'layer', 'dialog'], function() {
        var $ = layui.jquery;
        var dialog = layui.dialog;
        //顶部批量删除
        $('.status').click(function() {
            var id = $(this).attr('data-id');;
            var status=$(this).attr('data-status');
            var message =  status==0?'您确定要推送吗？':"您确定要关闭推送吗";
            dialog.confirm({
                message:message,
                success:function(){
                    $.ajax({
                        type: 'post',
                        url: '/index.php?r=admin/edit-message',
                        data: {id:id,status:status},
                        dataType: 'json',
                        success: function (data) {
                            layer.msg(data.msg);
                            if (data.code == 200) {
                               location.reload()
                            }
                        }
                    });
                },
                cancel:function(){

                }
            })
            return false;

        })
        $(".addBtn1").click(function(){
            var url = $(this).attr('data-url');
            layer.open({
                type: 2,
                content: '/index.php?r=admin/add-message', //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                area:["600px","300px"]
            });
        })
        $(".edit-btn1").click(function(){
            var id = $(this).attr('data-id');;
            layer.open({
                type: 2,
                content: '/index.php?r=admin/add-message&id='+id, //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                area:["600px","300px"]
            });
        })


    });
</script>
</body>

</html>

