

function closeMain(){
 $(".main").hide();
 clearInterval();
}
function setCookie(c_name,value,expiredays)
{
  var exdate=new Date()
  exdate.setDate(exdate.getDate()+expiredays)
  document.cookie=c_name+ "=" +escape(value)+
  ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
function getCookie(c_name)
{
  if (document.cookie.length>0)
    {
    c_start=document.cookie.indexOf(c_name + "=")
    if (c_start!=-1)
      { 
      c_start=c_start + c_name.length+1 
      c_end=document.cookie.indexOf(";",c_start)
      if (c_end==-1) c_end=document.cookie.length
      return unescape(document.cookie.substring(c_start,c_end))
      } 
    }
  return ""
}
$(function(){  
  function baoguan(info) {
    $.post('/welcome/info', {id:info.id,cid:info.cid},function (data) {
      console.log(data);
    });
  }
  function run() {
    info = eval(getCookie('info'));
    cookiev = getCookie('guidnum'+num);
    if (cookiev) {} else {
      console.log(info[num]);
      baoguan(info[num])
      setCookie('guidnum'+num, guid+num, 10)
    }
    if (info[num].link) {
      var htmls='<a style="margin-left: 10px;" href="/welcome/redirect/'+info[num].link+ '/' + info[num].id+'" target="_blank">'+info[num].title+'</a>';
    } else {
      var htmls='<a style="margin-left: 10px;" href="#" onclick="return false" target="_blank">'+info[num].title+'</a>';
    }
    $('.marquee').fadeOut('slow', function(){$('.marquee').html(htmls)});
    $('.marquee').fadeIn('slow');
    num++;
    if (num == info.length) {num=0};
    // $.post('/welcome/info',{guid:guid,num:num,t:t}, function(data){
    //   if (cookiev) {} else {
    //     setCookie('guidnum'+num, guid+num, 10)
    //   }
    //   if (num >= data.info.count) {num = 0;};
    //   if (data.info == null) {$('.marquee').html('<a style="margin-left: 10px;" href="#">客户ID不存在,请重新配</a>');return;};
    //   if (data.info.link) {
    //     var info='<a style="margin-left: 10px;" href="/welcome/redirect/'+data.info.link+ '/' + data.info.id+'" target="_blank">'+data.info.title+'</a>';
    //   } else {
    //     var info='<a style="margin-left: 10px;" href="#" onclick="return false" target="_blank">'+data.info.title+'</a>';
    //   }
    //   $('.marquee').fadeOut('slow', function(){$('.marquee').html(info)});
    //   $('.marquee').fadeIn('slow');
    //   num++;
    // })
  }
  num     =0;
  guid    =$('.weibo').attr('guid');
  run()
  setInterval(run, 5000)
})
