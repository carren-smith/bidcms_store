<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: session.class.php 2010-08-24 10:42 $
*/
if(!defined('IN_BIDCMS')) {
	exit('Access Denied');
}
define('BIDCMS_REDIS',0);
//状态
$version=array('0'=>'免费版','1'=>'商户版');
$order_status=array('-6'=>'退款成功','-5'=>'退换货失败','-4'=>'退换货处理中','-3'=>'交易关闭','-2'=>'退款处理中','-1'=>'已取消','0'=>'待付款','1'=>'待发货','2'=>'卖家已发货','3'=>'已完成','4'=>'已评价');
$pay_status=array('未支付','已支付');
$letter_group=array("1"=>"所有会员","2"=>"所有分销商","3"=>"指定等级会员","4"=>"指定等级分销商","5"=>"无成交的会员","6"=>"无成交的分销商","7"=>"已成交的会员","8"=>"已成交的分销商");
$shipping_type=array('express'=>'快递','ems'=>'EMS','surface'=>'平邮',"distribution"=>'商家配送');
$templates=array("1","2","3","4","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","22","23","25");
$widgets=array("1"=>"富文本","2"=>"标题","3"=>"横排商品","4"=>"自定义商品","6"=>"商品搜索","7"=>"文本导航","8"=>"图片导航","9"=>"图片广告","10"=>"分割线","11"=>"辅助空白","12"=>"顶部菜单","13"=>"橱窗","14"=>"视频","15"=>"音频","16"=>"公告","17"=>"内容","18"=>"微排版","19"=>"商品选项卡","20"=>"商品促销","22"=>"商家信息","23"=>"优惠券","25"=>"附近商家");
$freight_company=array("1"=>"顺丰","2"=>"申通|STO","3"=>"圆通|YTO","4"=>"EMS|EMS","5"=>"中通|ZTO","6"=>"韵达|YD","7"=>"邮政包裹|YZPY","8"=>"宅急送|ZJS","9"=>"天天|HHTT","10"=>"自定义","11"=>"汇通","12"=>"Aramex","13"=>"AAE","14"=>"安捷","15"=>"安信达","16"=>"百福东方","17"=>"程光","18"=>"德邦|DBL","19"=>"DPEX","20"=>"D速","21"=>"DHL","22"=>"大田","23"=>"FedEx国际","24"=>"富腾达","25"=>"FedEx","26"=>"凤凰","27"=>"共速达","28"=>"能达","29"=>"国通|GTO","30"=>"华企","31"=>"恒路","32"=>"嘉里物流","33"=>"佳吉","34"=>"晋越","35"=>"京广","36"=>"佳怡","37"=>"加运美","38"=>"急先达","39"=>"快捷","40"=>"联昊通","41"=>"龙邦","42"=>"民航","43"=>"配思航宇","44"=>"跨越","45"=>"全峰","46"=>"全晨","47"=>"全一","48"=>"如风达","49"=>"三态","50"=>"盛丰","51"=>"盛辉","52"=>"天地华宇","53"=>"TNT","54"=>"UPS","55"=>"万象","56"=>"文捷航空","57"=>"信丰","58"=>"新邦","59"=>"易达通","60"=>"远成","61"=>"越丰","62"=>"原飞航","63"=>"亚风","64"=>"优速|UC","65"=>"运通","66"=>"易通达","67"=>"源安达","68"=>"中邮","69"=>"中国东方","70"=>"中铁");
$reason=array("7天无理由退换货","退运费","大小/尺寸与商品描述不符","颜色/图案/款式与商品描述不符","材质面料与商品描述不符","做工问题","缩水/褪色","少件/漏发","包装/商品破损/污渍","假冒品牌","未按约定时间发货","发票问题","卖家发错货");