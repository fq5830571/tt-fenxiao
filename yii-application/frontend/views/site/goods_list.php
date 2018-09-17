<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>旗舰店---精选优质产品</title>
    <link href="../Public/Static/css/base.css" type="text/css" rel="stylesheet">
    <link href="../Public/Static/css/index.css" type="text/css" rel="stylesheet">
    <link href="../Public/Static/css/search_result.css" type="text/css" rel="stylesheet">
    <link href="../Public/Static/css/itemListTemplate.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="div_header">
    <a href="index.php?g=App&m=Index&a=member&refresh=1"><span class="content-picture">

					<img class='image' src="/Public/Static/images/defult.jpg">

		</span></a>
    <span class="header_right">
				<div class="header_l_di"><span style='color:red'><?= $user['name'] ?></span></div>
				<div><span>会员编号：<?= $user['id'] ?></span></div>
				<div><span><?= date('Y-m-d', $user['created_time']) ?></span></div>
		</span>
</div>
<header id="common_hd" class="c_txt rel ellipsis_common_hd">
    <div class="hot"><strong>★</strong></div>
    <h1 class="hd_tle bold">
        <marquee scrollamount=1 scrolldelay=7 direction=left>购买即可升级会员等级</marquee>
    </h1>
    <a class="head_btn_right" href="index.php?g=App&m=Index&a=fenlei"><i class="menu_header_home"></i></a>
</header>
<div style="display: none;" id="index_loading" class="loading">&nbsp;</div>
<section id="search-content">
    <div style="display: block;" class="i_wrap margin_auto rel hide" id="item_classes_list_wrap">
        <ul class="i_ul rel" id="hot_ul">
            <?php foreach ($goodsList as $goods) { ?>

                <li class="i_li left"><a href="/index.php?r=site/pay-view&id=<?=$goods['id']?>"><img width="293"
                                                                                                          height="370"
                                                                                                          src="<?= $goods['image'] ?>">
                        <div class="i_li_img_div abs wrap">
                            <div class="i_li_img_div_inner"><span class="sellerOut"></span></div>
                        </div>
                        <p class="i_txt"><?= $goods['goods_name'] ?></p>
                        </p>
                    </a></li>

            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</section>
</section>
<script src="../Public/Static/js/getItems.htm"></script>
<script src="../Public/Static/js/getPubInfo.htm"></script>
<script src="../Public/Static/js/itemListTemplate.js"></script>
<script src="../Public/Static/js/piwik.js" async="" defer="defer" type="text/javascript"></script>
<script src="../Public/Static/js/base_H5.js"></script>
<script>var Search = {
        params: {userID: M.urlQuery("userid"), cate_id: M.urlQuery("c"), pageNum: 0, pageSize: 10},
        item_empty: function () {
            $("#index_loading").hide(), $("#item_empty").show().addClass("item_empty_icon")
        },
        getShopinfo: function () {
            var e = {userID: Search.params.userID};
            M.jsonp("http://wd.koudai.com/wd/shop/getPubInfo?param=" + M.toJSON(e), function (e) {
                0 === Number(e.status.status_code) && $("#hd_enterShop").show().attr("href", "/?userid=" + Search.params.userID).find("img").eq(0).attr("src", e.result.logo).show()
            })
        },
        item_hot: function () {
            "none" == $$("#index_loading").style.display && Search.scroll_loading_txt.show(), Search.item_hot_handle && !Search.scroll_loading && (Search.scroll_loading = !0, M.jsonp("http://wd.koudai.com/wd/cate/getItems?param=" + M.toJSON(Search.params), function (e) {
                if (0 === Number(e.status.status_code)) {
                    $("#index_loading").hide();
                    var t = e.result, a = t.length;
                    if (!a) return 0 === Number(Search.params.pageNum) ? (Search.item_empty(), void(Search.item_hot_handle = !1)) : (Search.scroll_loading_txt.hide(), void(Search.item_hot_handle = !1));
                    Search.scroll_loading = !1;
                    var r = "";
                    M.urlQuery("f_seller_id") ? r = M.urlQuery("f_seller_id") : M.getCookie("f_seller_id") && (r = M.getCookie("f_seller_id"));
                    for (var o = $("#hot_ul"), i = "", l = 0; a > l; l++) {
                        var s = t[l];
                        i += ITEMLISTTEMPLATE({href: "/item.html?itemID=" + s.itemID + "&f_seller_id=" + r, data: s})
                    }
                    o.append(i).parent().show(), Search.params.pageNum++, a < Search.params.pageSize && (Search.scroll_loading_txt.hide(), Search.item_hot_handle = !1)
                } else M._alert(e.status.status_reason)
            }))
        },
        item_hot_handle: !0,
        scroll_loading: !1,
        max_top: 0,
        scroll_loading_txt: $("#scroll_loading_txt"),
        seller_id: M.urlQuery("userid"),
        init: function () {
            M.doHistory(Search.seller_id + "_iClass_refer"), M.gaq("选择浏览商品分类"), $("#item_classes_des").html(decodeURIComponent(M.urlQuery("des"))), Search.params.userID ? M.loadScript("http://s.koudai.com/script/common/itemListTemplate.js", function () {
                Search.getShopinfo(), Search.item_hot(), $(window).bind("scroll", function () {
                    var e = document.body.scrollTop || document.documentElement.scrollTop;
                    if (Search.item_hot_handle && !Search.scroll_loading) {
                        var t = document.documentElement.clientHeight, a = document.body.offsetHeight;
                        if (e > Search.max_top) {
                            Search.max_top = e;
                            var r = t + e + 100;
                            r >= a && Search.item_hot_handle && Search.item_hot()
                        }
                    }
                })
            }) : (Search.item_empty(), $("#item_empty").html(""))
        }
    };
    Search.init();</script>
<div class="c_txt rel ellipsis_common_hd"></div>

<style>
    .button_img {
        margin-left: 10px;
        height: 40px;
        float: left;
        margin-top: 3px;
    }

    .button_buy {
        margin-right: 10px;
        float: right;
    }

    .button_buy a p {
        height: 3em;
        overflow: hidden;
    }.i_txt,.i_pri_wrap{
		text-align: center;
	}
</style>
<div class="footermenu">
    <ul>
        <li>
            <div>
                <div><img class="button_img" src="/Public/Static/images/defult.jpg"></div>
                <div style="margin-top:5px;margin-left:10px;line-height: 1em;color:#fff;float:left"><span
                            style="color:#00cf31;font-size:12px;"><?=$user['name']?></span><br><span style="font-size:12px;">购买即可升级会员等级,提高佣金基数</span>
                </div>
            </div>
            <!--<a class="button_buy" href="index.php?g=App&amp;m=Index&amp;a=index&amp;id=1"><p style="line-height: 3em;">
                    <span style="padding:5px;border:1px solid #00cf31;"><strong>立即购买</strong></span></p></a></li>-->
    </ul>
</div>
</body>
</html>