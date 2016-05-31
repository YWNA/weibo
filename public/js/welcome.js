

function closeMain(){
 $(".main").hide();
 clearInterval();
}
$(function(){  
  function run() {
  $.post('/welcome/info',{cid:$('.weibo').attr('cid'),num:num}, function(data){
    if (num >= data.info.count) {num = 0;};
    if (data.info == null) {$('.marquee').html('<a style="margin-left: 10px;" href="#">客户ID不存在,请重新配</a>');return;};
    if (data.info.link) {
      var info='<a style="margin-left: 10px;" href="/welcome/redirect/'+data.info.link+ '/' + data.info.id+'" target="_blank">'+data.info.title+'</a>';
    } else {
      var info='<a style="margin-left: 10px;" href="#" onclick="return false" target="_blank">'+data.info.title+'</a>';
    }
    $('.marquee').fadeOut('slow', function(){$('.marquee').html(info)});
    $('.marquee').fadeIn('slow');
    num++;
  })
}
  num=1;
  run()
  setInterval(run, 3000)
})
