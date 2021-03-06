
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- 满足有些用户在手机端访问的需要 -->

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>短信充值记录 - Bidcms开源电商</title>

        <link rel="stylesheet" href="<?php echo SITE_ROOT;?>statics/css/component-min.css">    <link rel="stylesheet" href="<?php echo SITE_ROOT;?>statics/plugins/jbox/jbox-min.css">

</head>
<body class="cp-bodybox">
<?php include "views/global_top.php";?>

<div class="container">
    <div class="inner clearfix">
       <div class="content-left fl">
        <?php include "views/global_nav.php";?>
        </div>
        <div class="content-right">
            <h1 class="content-right-title">短信充值记录<a class="gicon-info-sign gicon_linkother" href="//www.wifenxiao.com/Index/help_show/lm/help/id/216.html" target="_blank"></a></h1>



    <div class="alert alert-info" style="line-height: 25px; height:30px;">当前可用短信数量：<span class="colorRed ftsize18">8</span> 条 <a href="index.php?con=sms&act=recharge" target="_blank" class="btn btn-small btn-primary mgl10 vtalgMid">立即充值</a></div>

    <table class="wxtables mgt15">
        <thead>
        <tr>
            <td>充值时间</td>
            <td>充值前可用短信数量</td>
            <td>充值短信数量</td>
            <td>充值后可用短信数量</td>
            <td>充值方式</td>
            <td>充值金额</td>
        </tr>
        </thead>
        <tbody>
        <tr>
                <td>2016-05-10 09:27</td>
                <td>0 条</td>
                <td>10 条</td>
                <td>10 条</td>
                <td>软件赠送</td>
                <td>0 元</td>
            </tr>        </tbody>
    </table>

    <div class="tables-btmctrl clearfix">
        <div class="fr">
            <div class="paginate">
                            </div>
            <!-- end paginate -->
        </div>
    </div>
    <!-- end tables-btmctrl -->

        </div>
        <!-- end content-right -->

        <a href="javascript:;" class="btn-leftMenuFold" id="j-btn-leftMenuFold" ></a>
    </div>
</div>
<!-- end container -->


<!-- end footer -->
    <div class="fixedBar">
        <ul>
            <li class="shopManager21"><a href="javascript:;" data-target="#shop_21">系统设置</a></li><li class="shopManager22"><a href="javascript:;" data-target="#shop_22">域名管理</a></li><li class="shopManager23"><a href="javascript:;" data-target="#shop_23">在线客服</a></li><li class="shopManager24"><a href="javascript:;" data-target="#shop_24">微信设置</a></li><li class="shopManager25"><a href="javascript:;" data-target="#shop_25">素材库</a></li><li class="shopManager26"><a href="javascript:;" data-target="#shop_26">短信</a></li><li class="shopManager27"><a href="javascript:;" data-target="#shop_27">物流管理</a></li><li class="shopManager29"><a href="javascript:;" data-target="#shop_29">系统日志</a></li>        </ul>
        <a href="javascript:;" class="fixedBar-btn" id="j-fixedBar-btn"></a>
    </div><a href="#" id="j-gotop" class="gotop" title="回到顶部"></a>
<!-- end gotop -->
<?php include "views/global_footer.php";?>
</body>
</html>
<!-- 20170105 -->
