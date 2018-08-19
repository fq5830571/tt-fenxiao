<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../Public/Static/css/foods.css?444" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
    <script type="text/javascript" src="../Public/Static/js/wemall.js"></script>
    <script type="text/javascript" src="../Public/Static/js/alert.js"></script>
    <script type="text/javascript">
        var appurl = '__APP__';
        var rooturl = '__ROOT__';

    </script>
    <style>

        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px
        }

        .pagination > li {
            display: inline
        }

        .pagination > li > a, .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.428571429;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd
        }

        .pagination > li:first-child > a, .pagination > li:first-child > span {
            margin-left: 0;
            border-bottom-left-radius: 4px;
            border-top-left-radius: 4px
        }

        .pagination > li:last-child > a, .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px
        }

        .pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
            background-color: #eee
        }

        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #bf0060;
            border-color: #bf0060
        }

        .pagination > .disabled > span, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
            color: #999;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd
        }

        .pagination-lg > li > a, .pagination-lg > li > span {
            padding: 10px 16px;
            font-size: 18px
        }

        .pagination-lg > li:first-child > a, .pagination-lg > li:first-child > span {
            border-bottom-left-radius: 6px;
            border-top-left-radius: 6px
        }

        .pagination-lg > li:last-child > a, .pagination-lg > li:last-child > span {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px
        }

        .pagination-sm > li > a, .pagination-sm > li > span {
            padding: 5px 10px;
            font-size: 12px
        }

        .pagination-sm > li:first-child > a, .pagination-sm > li:first-child > span {
            border-bottom-left-radius: 3px;
            border-top-left-radius: 3px
        }

        .pagination-sm > li:last-child > a, .pagination-sm > li:last-child > span {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px
        }

        .pager {
            padding-left: 0;
            margin: 20px 0;
            text-align: center;
            list-style: none
        }

        .pager:before, .pager:after {
            display: table;
            content: " "
        }

        .pager:after {
            clear: both
        }

        .pager:before, .pager:after {
            display: table;
            content: " "
        }

        .pager:after {
            clear: both
        }

        .pager li {
            display: inline
        }

        .pager li > a, .pager li > span {
            display: inline-block;
            padding: 5px 14px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px
        }

        .pager li > a:hover, .pager li > a:focus {
            text-decoration: none;
            background-color: #eee
        }

        .pager .next > a, .pager .next > span {
            float: right
        }

        .pager .previous > a, .pager .previous > span {
            float: left
        }

        .pager .disabled > a, .pager .disabled > a:hover, .pager .disabled > a:focus, .pager .disabled > span {
            color: #999;
            cursor: not-allowed;
            background-color: #fff
        }

    </style>
</head>
<body class="sanckbg mode_webapp">

<div id="member-container" style="display: block;">

    <div class="div_header">
			<span style='float:left;margin-left:10px;margin-right:10px;'>
				<php>
					<img src="/Public/Static/images/defult.jpg" width='70px;' height='70px;'>
				</php>
			</span>
        <span class="header_right">
				<div class="header_l_di">
					<span>昵称：<?=$user['name']?></span>&nbsp;&nbsp;
				</div>

				<div><span>注册时间：<?php echo date('Y-m-d',$user['created_time']);?></span></div>
			</span>
    </div>

    <div class="div_table" style='background-color:#e61945;height:20px;padding:10px;'>
        <table>
            <tr><td>我的分销：部分会员(<?=count($memberList)?>)人</td></tr>
        </table>
    </div>
<!--
    <div style="text-align:center; margin:5 auto;">
        <span ><input style="width:80%;border: 1px solid #D00A0A;height: 22px;"  id="name" name="name" placeholder="请输入会员ID" value="" type="text" ></span>
        <span><input style="width:10%;margin-left:10px;border: 1px solid #D00A0A;height: 22px;" type='button' onclick='search_user();' value='搜索'></span>
    </div>-->

    <div class="cardexplain">
        <ul class="round_user">
            <?php foreach ($memberList as $member){?>
                <li>
                    <div style="">
							<span style='float:left;margin-left:10px;margin-right:10px;margin-top:5px;'>

								<img src="/Public/Static/images/defult.jpg" width='40px;' height='40px;'>
							</span>
                        <span class="header_right" style="margin-top:5px;">
								<div class="header_l_di"><span>昵称：<php></php></span></div>
								<div><span>合伙人：<if condition="$result.member eq 1">是<else/>否<a style='color:red' href='./index.php?g=App&m=Index&a=index'>点击链接成为合伙人</a></if></span></div>
								<div><span>关注时间：<?php echo date('Y-m-d',$member['created_time']);?></span></div>
								<div><span>会员ID：<?=$member['id']?>  </span></div>
							</span>
                    </div>
                </li>
            <?php }?>
        </ul>
    </div>
</div>

<script>
    function search_user()
    {
        var user = $('#name').val();
        location.href='./index.php?g=App&m=Index&a=member_info&type='+$_GET['type']+'&id='+$_GET['id']+'&user='+user;
    }
</script>

<div class="pagination" style="margin:0 auto;">
    <?= \yii\widgets\LinkPager::widget(['pagination' => $pages]); ?>
</div>
</body>
</html>