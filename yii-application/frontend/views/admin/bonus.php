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
    <title>佣金明细</title>
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
    <form class="layui-form"  action="/index.php?r=admin/bonus-view" method="post">
        <div class="layui-form-item">
            <div class="layui-inline">
                <input type="text" name="name" placeholder="请输入姓名" autocomplete="off" class="layui-input">
            </div>
            <button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>
        </div>
    </form>
    <div class="layui-form" id="table-list">
        <table class="layui-table" lay-even lay-skin="nob">
            <colgroup>
                <col width="100">
                <col width="100">
                <col width="100">
                <col width="200">
                <col width="200">
                <col  width="100">
                <col  width="100">
            </colgroup>
            <thead>
            <tr>
                <!--<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>-->
                <th >昵称</th>
                <th >小区</th>
                <th >姓名</th>
                <th >获得佣金金额</th>
                <th >关联订单编号</th>
                <th >账户余额</th>
                <th>获得时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($bonusList as $bonus){?>
            <tr>
                <td class="hidden-xs"><?=$bonus['name']?></td>
                <td class="hidden-xs"><?=$bonus['shequ_name']?></td>
                <td class="hidden-xs"><?=$bonus['username']?></td>
                <td class="hidden-xs" style="color: forestgreen;">+<?=$bonus['bonus_amount']?></td>
                <td class="hidden-xs"><?=$bonus['order_sn']?></td>
                <td class="hidden-xs"><?=$bonus['balance']?></td>
                <td class="order_status"><?=$bonus['created_time']?></td>
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
        $('.pay').click(function() {
            var id=$(this).attr('data-id');
            var taht = $(this);
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
                                taht.parents('tr').find('.order_status').addClass('red')
                                taht.parents('tr').find('.order_status').html('已支付')
                                taht.parents('tr').find('.pay').html('已支付')
                                taht.parents('tr').find('.pay').removeClass('layui-btn-danger')
                            }
                        }
                    });
                },
                cancel:function(){

                }
            })
            return false;

        })

    });
</script>
</body>

</html>

