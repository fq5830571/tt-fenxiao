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
    <title>用户管理</title>
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
                <th >用户id</th>
                <th >姓名</th>
                <th >身份证</th>
                <th >小区</th>
                <th >群编号</th>
                <th >上级</th>
                <th >等级</th>
                <th >余额</th>
                <th >电话</th>
                <th>创建时间</th>
                <th>设置会员等级</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userList as $user){?>
            <tr>
                <td class="hidden-xs"><?=$user['id']?></td>
                <td class="hidden-xs"><?=$user['username']?></td>
                <td class="hidden-xs"><?=$user['card']?></td>
                <td class="hidden-xs"><?=$user['shequ_name']?></td>
                <td class="hidden-xs"><?=$user['p_id']?$user['p_id']:$user['id']?></td>
                <td class="hidden-xs"><?=$user['parent_name']?></td>
                <td class="hidden-xs"><?=$user['level_name']?></td>
                <td class="hidden-xs"><?=$user['balance']?></td>
                <td class="hidden-xs"><?=$user['phone']?></td>
                <td><?=date('Y-m-d H:i:s',$user['created_time'])?></td>
                <th>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-mini layui-btn-normal  edit-btn1" data-id="1" data-url="/index.php?r=admin/set-level&id=<?=$user['id']?>"><i class="layui-icon"></i></button>
                    </div>
                </th>
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
        $(".edit-btn1").click(function(){
            var url = $(this).attr('data-url');
            layer.open({
                type: 2,
                content: [url], //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                area:["600px","300px"]
            });
        })


    });
</script>
</body>

</html>

