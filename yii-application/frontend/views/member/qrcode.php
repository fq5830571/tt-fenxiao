<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/Public/Static/css/foods.css?t=333" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/Public/Static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/js/wemall.js?14115"></script>
    <script type="text/javascript" src="/jquery.qrcode.min.js"></script>
    <script type="text/javascript" src="/Public/Static/js/alert.js"></script><style type="text/css">

                                                                     <style type="text/css">
        .window {
            width:290px;
            position:fixed;
            display:none;
            bottom:30px;
            left:50%;
            z-index:9999;
            margin:-50px auto 0 -145px;
            padding:2px;
            border-radius:0.6em;
            -webkit-border-radius:0.6em;
            -moz-border-radius:0.6em;
            background-color: #ffffff;
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            font:14px/1.5 Microsoft YaHei,Helvitica,Verdana,Arial,san-serif;
        }
        .window .title {

            background-color: #A3A2A1;
            line-height: 26px;
            padding: 5px 5px 5px 10px;
            color:#ffffff;
            font-size:16px;
            border-radius:0.5em 0.5em 0 0;
            -webkit-border-radius:0.5em 0.5em 0 0;
            -moz-border-radius:0.5em 0.5em 0 0;
            background-image: -webkit-gradient(linear, left top, left bottom, from( #585858 ), to( #565656 )); /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient(#585858, #565656); /* Chrome 10+, Saf5.1+ */
            background-image:    -moz-linear-gradient(#585858, #565656); /* FF3.6 */
            background-image:     -ms-linear-gradient(#585858, #565656); /* IE10 */
            background-image:      -o-linear-gradient(#585858, #565656); /* Opera 11.10+ */
            background-image:         linear-gradient(#585858, #565656);

        }
        .window .content {
            /*min-height:100px;*/
            overflow:auto;
            padding:10px;
            background: linear-gradient(#FBFBFB, #EEEEEE) repeat scroll 0 0 #FFF9DF;
            color: #222222;
            text-shadow: 0 1px 0 #FFFFFF;
            border-radius: 0 0 0.6em 0.6em;
            -webkit-border-radius: 0 0 0.6em 0.6em;
            -moz-border-radius: 0 0 0.6em 0.6em;
        }
        .window #txt {
            min-height:30px;font-size:16px; line-height:22px;
        }
        .window .txtbtn {

            background: #f1f1f1;
            background-image: -webkit-gradient(linear, left top, left bottom, from( #DCDCDC ), to( #f1f1f1 )); /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient( #ffffff , #DCDCDC ); /* Chrome 10+, Saf5.1+ */
            background-image:    -moz-linear-gradient( #ffffff , #DCDCDC ); /* FF3.6 */
            background-image:     -ms-linear-gradient( #ffffff , #DCDCDC ); /* IE10 */
            background-image:      -o-linear-gradient( #ffffff , #DCDCDC ); /* Opera 11.10+ */
            background-image:         linear-gradient( #ffffff , #DCDCDC );
            border: 1px solid #CCCCCC;
            border-bottom: 1px solid #B4B4B4;
            color: #555555;
            font-weight: bold;
            text-shadow: 0 1px 0 #FFFFFF;
            border-radius: 0.6em 0.6em 0.6em 0.6em;
            display: block;
            width: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            text-align: windowcenter;
            font-weight: bold;
            font-size: 18px;
            padding:6px;
            margin:10px 0 0 0;
        }
        .window .txtbtn:visited {
            background-image: -webkit-gradient(linear, left top, left bottom, from( #ffffff ), to( #cccccc )); /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient( #ffffff , #cccccc ); /* Chrome 10+, Saf5.1+ */
            background-image:    -moz-linear-gradient( #ffffff , #cccccc ); /* FF3.6 */
            background-image:     -ms-linear-gradient( #ffffff , #cccccc ); /* IE10 */
            background-image:      -o-linear-gradient( #ffffff , #cccccc ); /* Opera 11.10+ */
            background-image:         linear-gradient( #ffffff , #cccccc );
        }
        .window .txtbtn:hover {
            background-image: -webkit-gradient(linear, left top, left bottom, from( #ffffff ), to( #cccccc )); /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient( #ffffff , #cccccc ); /* Chrome 10+, Saf5.1+ */
            background-image:    -moz-linear-gradient( #ffffff , #cccccc ); /* FF3.6 */
            background-image:     -ms-linear-gradient( #ffffff , #cccccc ); /* IE10 */
            background-image:      -o-linear-gradient( #ffffff , #cccccc ); /* Opera 11.10+ */
            background-image:         linear-gradient( #ffffff , #cccccc );
        }
        .window .txtbtn:active {
            background-image: -webkit-gradient(linear, left top, left bottom, from( #cccccc ), to( #ffffff )); /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient( #cccccc , #ffffff ); /* Chrome 10+, Saf5.1+ */
            background-image:    -moz-linear-gradient( #cccccc , #ffffff ); /* FF3.6 */
            background-image:     -ms-linear-gradient( #cccccc , #ffffff ); /* IE10 */
            background-image:      -o-linear-gradient( #cccccc , #ffffff ); /* Opera 11.10+ */
            background-image:         linear-gradient( #cccccc , #ffffff );
            border: 1px solid #C9C9C9;
            border-top: 1px solid #B4B4B4;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3) inset;
        }

        .window .title .close {
            float:right;
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAACTSURBVEhL7dNtCoAgDAZgb60nsGN1tPLVCVNHmg76kQ8E1mwv+GG27cestQ4PvTZ69SFocBGpWa8+zHt/Up+IN+MhgLlUmnIE1CpBQB2COZibfpnXhHFaIZkYph0SOeeK/QJ8o7KOek84fkCWSBtfL+Ny2MPpCkPFMH6PWEhWhKncIyEk69VfiUuVhqJefds+YcwNbEwxGqGIFWYAAAAASUVORK5CYII=");
            width:26px;
            height:26px;
            display:block;
        }
         canvas{
             width: 38%;
             margin-left: 30%;
             margin-top: 12%;
         }
    </style>
</head><body class="sanckbg mode_webapp"><div class="window" id="windowcenter">
    <div id="title" class="title">消息提醒<span class="close" id="alertclose"></span></div>
    <div class="content">
        <div id="txt"></div>
        <input type="button" value="确定" id="windowclosebutton" name="确定" class="txtbtn">
    </div>
</div>

<script type="text/javascript">
    var appurl = '/index.php';
    var rooturl = '';

    $(function () {
        $("#all_cnt").click(function(){
            $(".member_cnt").toggle();
            if($(this).find('img').attr("src")=="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png")
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_click.png");
            }
            else
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png");
            }
        });

        $("#all_price").click(function(){
            $(".price_cnt").toggle();
            if($(this).find('img').attr("src")=="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png")
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_click.png");
            }
            else
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png");
            }
        });

        $("#memeber_url").click(function(){
            $(".memeber_url").toggle();
            if($(this).find('img').attr("src")=="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png")
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_click.png");
            }
            else
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png");
            }
        });

        $("#all_buy").click(function(){
            $(".buy_cnt").toggle();
            if($(this).find('img').attr("src")=="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png")
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_click.png");
            }
            else
            {
                $(this).find('img').attr("src","/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png");
            }
        });

    });

</script>



<div id="member-container" style="display: none;">

    <div class="menu_header">
        <div class="menu_topbar">
            <div id="menu" class="sort ">
                <a href="">分销详情</a>
            </div>
        </div>
    </div>

    <div class="div_header">
			<span style="float:left;margin-left:10px;margin-right:10px;">

            </span>
        <span class="header_right">
				<div class="header_l_di">
					<span>昵称：fq1307400</span>&nbsp;&nbsp;
					&lt;<a style="color:red" href="./index.php?g=App&amp;m=Member&amp;a=index&amp;uid=50003">账号设置</a>&gt;
				</div>
				<div><span>合伙人：否(<a style="color:red" href="./index.php?g=App&amp;m=Index&amp;a=index">点击链接成为合伙人</a>)</span></div>
				<div><span>关注时间：2018-08-19&nbsp;&nbsp;<a style="color:red" href="./index.php?g=App&amp;m=Member&amp;a=logout">退出登录</a>&gt;</span></div>
				<div><span> 会员ID：50003
				   </span></div>
		</span></div>

    <div class="div_table">
        <table style="height:35px;text-align:center;background-color:#e61945;border:0px" border="0">
            <tbody><tr style="border:0px" border="0"><td style="background-color:#e61945;">销售额：0元</td><td style="border-left:1px solid #fff;background-color:#e61945;">我的佣金：0.00元</td></tr>
            </tbody></table>

    </div>

    <div class="cardexplain" style="TEXT-ALIGN: center;color:#000;font-size:14px;">您是由【fq5830571】推荐</div>
    <div class="cardexplain" style="TEXT-ALIGN: center;color:#006400;font-size:13px;"><marquee scrollamount="1" scrolldelay="7" direction="left">欢迎使用直销360分销系统</marquee></div>
    <div class="cardexplain">
        <div class="div_ul" id="all_cnt"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">家族成员</span><span class="bg_total">0 人</span></div>
        <ul class="round">
            <li class="member_cnt" style=""><a href="http://www.fenxiao.dev/index.php?g=App&amp;m=Index&amp;a=member_info&amp;type=1&amp;id=50003"><span><img style="width:20px;height:20px;" src="/Application/Tpl/App/default/Public/Static/images/bullet_blue_expand.png">一级会员<span style="float:right;color:red;">0</span></span></a></li>
            <li class="member_cnt"><a href="http://www.fenxiao.dev/index.php?g=App&amp;m=Index&amp;a=member_info&amp;type=2&amp;id=50003"><span><img style="width:20px;height:20px;" src="/Application/Tpl/App/default/Public/Static/images/bullet_blue_expand.png">二级会员<span style="float:right;color:red;">0</span></span></a></li>
            <li class="member_cnt"><a href="http://www.fenxiao.dev/index.php?g=App&amp;m=Index&amp;a=member_info&amp;type=3&amp;id=50003"><span><img style="width:20px;height:20px;" src="/Application/Tpl/App/default/Public/Static/images/bullet_blue_expand.png">三级会员<span style="float:right;color:red;">0</span></span></a></li>
        </ul>
    </div>

    <div class="cardexplain">

        <div class="div_ul" id="all_buy"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">家族推广<span class="bg_total">0 单</span></span></div>
        <ul class="round">
            <li class="buy_cnt"><span>下单未购买<span style="float:right;color:red;">0</span></span></li>
            <li class="buy_cnt"><span>下单已购买<span style="float:right;color:red;">0</span></span></li>
        </ul>
    </div>


    <div class="cardexplain">
        <div class="div_ul" id="all_price"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">我的佣金<span class="bg_total">0.00 元</span></span></div>
        <ul class="round">
            <li class="price_cnt"><span>未付款定单佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>已付款定单佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>已收货定单佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>已完成定单佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>待审核提现佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>已提现佣金<span style="float:right;color:red;">0</span></span></li>
            <li class="price_cnt"><span>可提现佣金<span style="float:right;color:red;">0.00</span></span></li>
        </ul>
    </div>
    <div class="cardexplain">
        <div class="div_ul" onclick="$('#tx').click();"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">申请提现</span></div>
    </div>
    <div class="cardexplain">
        <div class="div_ul" id="memeber_url"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">分享链接</span></div>
        <span class="memeber_url" style="display:none;">http://www.fenxiao.dev/index.php?g=App&amp;m=Member&amp;a=register&amp;mid=50003</span>
    </div>
    <div class="cardexplain">
        <a href="./index.php?g=App&amp;m=Index&amp;a=member_top&amp;id=50003"><div class="div_ul" id="top_url"><span><img style="margin-left:5px;" src="/Application/Tpl/App/default/Public/Static/images/arrow_unclick.png">销售排行榜</span></div></a>
    </div>
    <div style="text-align:center;"></div>
</div>

<div id="ticket-container" style="">
    <div id="qrcode" ></div>
</div>

<div id="tx-container" style="display: none;">

    <div class="menu_header">
        <div class="menu_topbar">
            <div id="menu" class="sort ">
                <a href="">申请提现</a>
            </div>
        </div>
    </div>

    <div class="div_header">
			<span style="float:left;margin-left:10px;margin-right:10px;">
				<img src="/Application/Tpl/App/default/Public/Static/images/defult.jpg" width="70px;" height="70px;">			</span>
        <span class="header_right">
				<div><span>昵称：fq1307400</span></div>
				<div><span>合伙人：否(<a style="color:red" href="./index.php?g=App&amp;m=Index&amp;a=index">点击链接成为合伙人</a>)</span></div>
				<div><span>关注时间：2018-08-19</span></div>
				<div><span>会员ID：50003  </span></div>
			</span>
    </div>

    <section class="order">
        <form name="txinfoForm" id="txinfoForm" method="post" action="">
            <div class="contact-info">
                <ul>
                    <li class="title">提现信息</li>
                    <li>
                        <table style="padding: 0; margin: 0; width: 100%;">
                            <tbody>
                            <tr>
                                <td width="80px"><label for="price" class="ui-input-text">提现金额：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input id="price" name="price" placeholder="" value="0.00" type="text" class="ui-input-text">
                                    </div></td>
                            </tr>

                            <tr>
                                <td width="80px"><label for="bank_name" class="ui-input-text">开户行：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input id="bank_name" name="bank_name" placeholder="" value="" type="text" class="ui-input-text">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="80px"><label for="bank_num" class="ui-input-text">开户账号：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input id="bank_num" name="bank_num" placeholder="" value="" type="text" class="ui-input-text">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="80px"><label for="name" class="ui-input-text">开户人姓名：</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input id="name" name="name" placeholder="" value="" type="text" class="ui-input-text">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="80px"><label for="bank_name" class="ui-input-text">电话</label></td>
                                <td>
                                    <div class="ui-input-text">
                                        <input id="tel" name="tel" placeholder="" value="" type="tel" class="ui-input-text">
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="footReturn">
                            <a id="txshowcard" class="submit" href="javascript:submitTxOrder();">确定提交</a>
                        </div>

                    </li>
                </ul>
            </div>
        </form>
    </section>

    <!-- 正在提交数据 -->
    <div id="tx-menu-shadow" hidefocus="true" style="display: none; z-index: 10;">
        <div class="btn-group" style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
            <div class="del" style="font-size: 14px;">
                <img src="/Application/Tpl/App/default/Public/Static/images/ajax-loader.gif" alt="loader">正在提交申请...
            </div>
        </div>
    </div>

    <ul class="round">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
            <tbody><tr>
                <th>编号</th>
                <th class="cc">金额</th>
                <th class="cc">状态</th>
            </tr>
            </tbody><tbody>
            </tbody>
        </table>
    </ul>


</div>


<div id="user-container" style="display: none;">

    <div class="menu_header">
        <div class="menu_topbar">
            <div id="menu" class="sort ">
                <a href="">查看我的订单</a>
            </div>
        </div>
    </div>

    <div>
        <ul class="round" style="margin:0;padding:0;border-radius:0;border:0px;border-bottom:1px solid #C6C6C6">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
                <tbody><tr>
                    <td> <span>订单详情</span> <span style="float:right"><a href='javascript:$("#ticket").click();' style="color:red;">获取推广二维码&gt;&gt;&gt;</a></span> </td>
                </tr>
                </tbody></table>
        </ul>
    </div>

    <div class="cardexplain">
        <div id="page_tag_load" hidefocus="true" style="display: none; z-index: 10;">
            <div class="btn-group" style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
                <div class="del" style="font-size: 14px;">
                    <img src="/Application/Tpl/App/default/Public/Static/images/ajax-loader.gif" alt="loader">正在获取订单...
                </div>
            </div>
        </div>
        <ul class="round" id="orderlistinsert" style="color:#000;font-size:12px;">
            <!--插入订单ul-->
        </ul>
    </div>
</div>

<div class="footermenu">
    <ul>
        <li><a href="./index.php?g=App&amp;m=Index&amp;a=listsp&amp;id=1" class=""> <img src="/Public/Static/images/21.png">
                <p>立即购买</p>
            </a></li>
        <li id="user"><a href="javascript:void(0);" class=""> <img src="/Public/Static/images/22.png">
                <p>我的订单</p>
            </a></li>
       <!-- <li id="member"><a href="javascript:void(0);" class=""> <img src="/Public/Static/images/23.png">
                <p>销售业绩</p>
            </a></li>-->
        <li id="ticket"><a href="javascript:void(0);" class="active"> <img src="/Public/Static/images/24.png">
                <p>我的二维码</p>
            </a></li>
        <li style="display:none;" id="tx"><a href="javascript:void(0);" class=""> <img src="/default/Public/Static/images/24.png">
                <p>我的二维码</p>
            </a></li>
    </ul>
</div>
<script>
    jQuery(function(){
        jQuery('#qrcode').qrcode("<?=$link?>");
    })
</script>

</body></html>