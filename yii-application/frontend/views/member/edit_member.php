<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/Public/Static/css/foods.css?t=333" rel="stylesheet"
          type="text/css">
    <script type="text/javascript" src="/Public/Static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/js/wemall.js?14115"></script>
    <script type="text/javascript" src="/Public/Static/js/alert.js"></script>
    <script type="text/javascript">
        var appurl = '__APP__';
        var rooturl = '__ROOT__';
    </script>
    <style type="text/css">
        #portrait_src {
            width: 65px;
            float: left;
            height: 65px;
        }
    </style>
</head>
<script>
    <?php if(isset($msg)){?>
    alert("<?=$msg?>");
    <?php }?>
</script>
<body class="sanckbg mode_webapp">
<div id="tx-container">
    <div class="div_header">
			<span style='float:left;margin-left:10px;margin-right:10px;'>
					<img src='<?=$user['image']?$user['image']:'/Public/Static/images/defult.jpg' ?>' width='70px;' height='70px;'>
			</span>
        <span class="header_right">
				<div class="header_l_di">
					<span>昵称：<?=$user['name']?$user['name']:$user['username']?></span>&nbsp;&nbsp;
				</div>
				<div><span>注册时间：<?php echo date('Y-m-d',$user['created_time']);?></span></div>
			</span>
    </div>
    <section class="order">
        <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="contact-info">
                <ul>
                    <li class="title" style="text-align: center;">用户信息</li>
                    <li>
                        <table style="padding: 0; margin: 0; width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="80px"><label for="price" class="ui-input-text">设置小区：</label></td>
                                    <td>
                                        <div class="ui-input-text">
                                            <input name="shequ_name" placeholder="" value="<?=$user['shequ_name']?>" type="text"
                                                   class="ui-input-text">
                                        </div>
                                    </td>
                                </tr>
                            <tr>
                                <td width="80px"><label for="price" class="ui-input-text">设置昵称：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input name="nickname" placeholder="" value="<?=$user['name']?$user['name']:$user['username']?>" type="text"
                                               class="ui-input-text">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="80px"><label for="price" class="ui-input-text">身份证号：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input name="card" placeholder="" value="<?=$user['card']?>" type="text"
                                               class="ui-input-text">
                                    </div>
                                </td>
                            </tr>

                            <!--<tr>
                                <td width="80px"><label for="bank_name" class="ui-input-text">密码：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input name="password" type="password" class="ui-input-text">
                                    </div>
                                    <span>留空则不修改</span>
                                </td>
                            </tr>-->
                            <?= $form->field($model, 'image') ->fileInput()->label('头像设置：') ?>
                            <?= $form->field($model, 'id') ->hiddenInput()->label('')?>
                            </tbody>
                        </table>
                        <div class="footReturn">
                            <input type="submit" class="submit" value="确定提交" style="margin: 0 auto;">
                        </div>
                    </li>
                </ul>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
    </section>
</div>
</body>
</html>