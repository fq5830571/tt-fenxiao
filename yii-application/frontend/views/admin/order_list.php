<?php

/* @var $this yii\web\View */

$this->title = '订单管理';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>网站后台管理模版</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
</head>

<body>
<div class="page-content-wrap">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <div class="layui-inline tool-btn">
                <button class="layui-btn layui-btn-small layui-btn-normal go-btn hidden-xs" data-url="danye-detail.html"><i class="layui-icon">&#xe654;</i></button>
                <button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn hidden-xs" data-url="/admin/category/listorderall.html"><i class="iconfont">&#xe656;</i></button>
            </div>
            <div class="layui-inline">
                <input type="text" name="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
            <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
        </div>
    </form>
    <div class="layui-form" id="table-list">
        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <col width="100">
                <col width="100">
                <col  width="100">
                <col  width="100">
                <col width="100">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <!--<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                <th >订单编号</th>
                <th >付款人</th>
                <th >支付金额</th>
                <th>支付状态</th>
                <th>支付时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orderList as $order){?>
            <tr>
                <td class="hidden-xs"><?=$order['order_sn']?></td>
                <td class="hidden-xs"><?=$order['name']?></td>
                <td class="hidden-xs"><?=$order['amount']?></td>
                <td class="order_status" style="<?=$order['status'] ==0?'color: #1E9FFF;':'color: red;'?>"><?=$order['status'] ==0?'未支付':'已支付'?></td>
                <td><?=$order['created_time']?></td>
                <td>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-mini <?=$order['status']==0?'layui-btn-danger':""?> del-btn pay" data-id="<?=$order['id']?>" ><?=$order['status']==0?'标记支付':"已支付"?></button>
                    </div>
                </td>
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
        //顶部批量删除
        $('.delBtn').click(function() {
            var id=$(this).attr('data-id');
            dialog.confirm({
                message:'您确定要标记已支付吗？',
                success:function(){
                    $.ajax({
                        type: 'post',
                        url: '/index.php?r=admin/pay-order',
                        data: {id:id},
                        dataType: 'json',
                        success: function (data) {
                            layer.msg(data.msg);
                            if (data.code == 200) {
                                //改变状态
                                $(this).parents('tr').find('.order_status').html('已支付')
                                $(this).parents('tr').find('.pay').html('已支付')
                                $(this).parents('tr').find('.pay').removeClass('layui-btn-danger')
                            }
                        }
                    });
                    layer.msg('标记成功')
                },
                cancel:function(){

                }
            })
            return false;

        }).mouseenter(function() {

            dialog.tips('批量删除', '.delBtn');

        })

    });
</script>
</body>

</html>

