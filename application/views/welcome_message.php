
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
	<title>banner</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<script src="<?php echo base_url() ?>public/js/jquery.js"></script>
  <style>
    body{
      padding:0;
      margin:0;
	    
    }
    .main {
      width:100%;
      height:50px;
      color:white;
      background: url('<?php echo base_url() ?>public/images/80.png') repeat;
      line-height: 50px;
      font-size: 16px;
position:absolute;
bottom:0;
    }
    .weibo{
      font-weight: bold;
      font-size: 18px;
      color: white;
      width:50px;
      position: absolute;
      top:0;
left:10px;
    }
    .close{
      position: absolute;
      top:0;
      right:10px;
      cursor: pointer;
      font-size: 18px;
      color: white;
    }
    .marquee{
      height:50px;

      margin: 0 50px 0 50px;
      padding: 0;
      position: absolute;
      top:0;
    }
	a{
	color:white;
text-decoration:none;
}
   
  </style>
  <script>
  function closeMain(){
   $(".main").hide();
  }
  function run() {
    $.get('welcome/info', function(data){
      var info='<a style="margin-left: 10px;" href="welcome/redirect/'+data.info.link+ '/' + data.info.id+'" target="_blank">'+data.info.title+'</a>';
      $('.marquee').html(info);
    })
  }
  run()
  setInterval("run()",5000)
  </script>
</head>
<body >
  <div class="main" >
    <div class="weibo">微播:</div>
    <div class="marquee">
      <a href="http://m.weibo.cn/u/2962998494" target="_blank"> 荣耀呈现，炫闪百大——王励勤鼓楼名品中心金座李宁新品见面会，你来了吗？小编高清大图放送哦~现场还有超划算的活动哦，全场满200元送200元电子券，扫二维码关注李宁，即可获赠王励勤现场抽奖礼品（U盘、李宁腰包等）及专厅现金抵用券（面额不等），你还不快来</a>
    </div>
    <div class="close" onclick="closeMain()">×</div>
  </div>
</body>
</html>