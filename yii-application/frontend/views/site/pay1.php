<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $goods['goods_name'] ?></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../Public/Static/css/foods.css?t=333" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
    <script type="text/javascript" src="../Public/Static/js/wemall.js?222"></script>
    <script type="text/javascript" src="../Public/Static/js/alert.js"></script>
    <script type="text/javascript" src="../Public/Static/js/area.js"></script>
    <script type="text/javascript">
        var appurl = '__APP__';
        var rooturl = '__ROOT__';
    </script>
</head>
<body class="sanckbg mode_webapp">
<div id="menu-container" style="display: none;">
    <div class="menu_header">
        <div class="menu_topbar">
            <div id="menu" class="sort sort_on">
                <a href="">{$info.name}</a>
                <ul>
                    <volist name="menu" id="menuid">
                        <li><a href="javascript:showProducts('{$menuid.id}')">{$menuid.name}</a></li>
                    </volist>
                    <li><a href="javascript:showAll()">所有商品</a></li>
                </ul>
            </div>
            <a class="head_btn_right" href="javascript:showMenu();"><i class="menu_header_home"></i> </a>
        </div>
    </div>
    <div class="gonggao">
        <div class="hot">
            <strong>公告</strong>
        </div>
        <div class="content">{$info.notification}</div>
    </div>
    <section class="menu">
        <section class="list listimg">
            <dl>
                <!--dt>菜单</dt-->
                <div class="ccbg">
                    <dd menu="{$goods.menu_id}" style="display:none;">
                        <div class="tupian">
                            <img src="<?= $goods['image'] ?>"> <a
                                    href="javascript:void (0);" class="add"><p
                                        class="dish2">{$goods.name}</p>
                                <p class="price2">{$goods.price}元/份</p>
                                <p>
                                    <del>{$goods.old_price}元/份</del>
                                </p>
                            </a>
                        </div>
                        <a href="javascript:doProduct('{$goods.id}','{$goods.name}','{$goods.price}','{$goods.commision}');"
                           id="{$goods.id}" class="reduce" style="display: block;"><b class="ico_reduce">减一份</b></a>
                    </dd>

                    <script>

                    </script>


                </div>
            </dl>
        </section>


        <div id="mcover" onClick="document.getElementById('mcover').style.display='';">
            <div id="Popup" style="display: block;">
                <div class="imgPopup">
                    <img id="detailpic" src="">
                    <!--h3 id="detailtitle"></h3-->
                    <p class="jianjie" id="detailinfo"></p>
                </div>
            </div>
            <a class="close" onClick="document.getElementById('mcover').style.display='';" style="display: none;">X</a>
        </div>

    </section>
</div>

<div id="cart-container" style="display: block;">
    <div class="menu_header">
        <div class="menu_topbar">
            <div id="menu" class="sort">
                <a href="">购买</a>
            </div>
        </div>
    </div>

   <!-- <img style="width:100%;" src='<?/*= $goods['image'] */?>'>-->

    <section class="order">
        <div class="orderlist">

            <ul id="ullist">
                <dt style="display:none;">已选购的</dt>
                <li class="ccbg2" id="wemall_1">
                    <div class="orderdish"><span name="title">申请购买</span>
                        <span class="price" id="v_0" style="display:none;">

                        </span>
                        <span style="display:none; class=" price"="">元</span></div>
                    <div class="orderchange">
                    </div>
                </li>
            </ul>

            <ul>
                <li class="ccbg2" id="emptyLii">价格￥<span> <input name="shequ_name" type="text" id="total_price" class="common-input" placeholder="请输入价格" style="width:90%;"></span>元</li>
            </ul>

            <div class="twobtn">
                <div class="footerbtn">
                    <a class="del right3" href="./index.php?r=site/index">返回首页</a>
                </div>
                <div class="footerbtn">
                    <a class="left3 submit buy" data-id="<?=$id?>">申请购买</a>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </section>
    <!-- 正在提交数据 -->
    <div id="menu-shadow" hidefocus="true"
         style="display: none; z-index: 10;">
        <div class="btn-group"
             style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
            <div class="del" style="font-size: 14px;">
                <img src="../Public/Static/images/ajax-loader.gif" alt="loader">正在提交订单...
            </div>
        </div>
    </div>
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
                <tr>
                    <td><span>订单详情</span> <span style='float:right'><a href='./index.php?g=App&m=Index&a=index_info'>继续购物>>></a></span>
                    </td>
                </tr>
            </table>
        </ul>
    </div>
    <div class="cardexplain">
        <div id="page_tag_load" hidefocus="true"
             style="display: none; z-index: 10;">
            <div class="btn-group"
                 style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
                <div class="del" style="font-size: 14px;">
                    <img src="../Public/Static/images/ajax-loader.gif" alt="loader">正在获取订单...
                </div>
            </div>
        </div>
        <ul class="round" id="orderlistinsert" style='color:#000;font-size:12px;'>
            <!--插入订单ul-->
        </ul>
    </div>
</div>
<div class="footermenu" style='display:none;'>
    <ul>
        <li><a class="active" href="./index.php?g=App&m=Index&a=index_info"> <img
                        src="../Public/Static/images/home.png">
                <p>首页</p>
            </a></li>

        <li id="cart"><a href="javascript:void(0);"> <span class="num" id="cartN2" style="display:none;">0</span> <img
                        src="../Public/Static/images/cart.png">
                <p>购买</p>
            </a></li>
        <li id="user"><a href="javascript:void(0);"> <img src="../Public/Static/images/user.png">
                <p>我的</p>
            </a></li>
    </ul>
</div>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form', 'jquery', 'layer', 'dialog'], function() {
        var $ = layui.jquery;
        var dialog = layui.dialog;
        var layer = layui.layer;
        //顶部批量删除
        $('.buy').click(function() {
            var id=$(this).attr('data-id');
            var num = $("#num_1_499").html();
            $.ajax({
                type: 'post',
                url: '/index.php?r=site/pay',
                data: {total_price:$("#total_price").val()},
                dataType: 'json',
                success: function (data) {
                    alert(data.msg);
                    setTimeout(function () {
                        if (data.code == 200) {
                            location.href = '/index.php?r=member/order';
                        }
                    },2000)
                }
            });
        })

    });
</script>
</body>
</html>