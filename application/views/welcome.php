<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
	<title>banner</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<script src="<?php echo base_url() ?>public/js/jquery.js"></script>
  <script src="<?php echo base_url() ?>public/js/welcome.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/welcome.css">
</head>
<body >
  <div class="main" >
    <div class="weibo" guid="<?php echo $guid; ?>"><?php echo $company_name_s ?>:</div>
    <div class="marquee">
      <!-- <a href="http://m.weibo.cn/u/2962998494" target="_blank"> 荣耀呈现，炫闪百大——王励勤鼓楼名品中心金座李宁新品见面会，你来了吗？小编高清大图放送哦~现场还有超划算的活动哦，全场满200元送200元电子券，扫二维码关注李宁，即可获赠王励勤现场抽奖礼品（U盘、李宁腰包等）及专厅现金抵用券（面额不等），你还不快来</a> -->
    </div>
    <div class="close" onclick="closeMain()">×</div>
  </div>
</body>
</html>