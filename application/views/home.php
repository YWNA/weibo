<?php
require __DIR__ . "\..\libraries\php-excel\Classes\PHPExcel.php";
function timeto($startdate, $enddate)
{
  $date   = floor((strtotime($enddate)-strtotime($startdate))/86400);
  $hour   = floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
  $minute = floor((strtotime($enddate)-strtotime($startdate))%86400/60);
  $second = floor((strtotime($enddate)-strtotime($startdate))%86400%60);
  return $date."天".$hour."小时";
}
?>
<div class="alert"></div>
<div class="alert alert-info">
  <?php echo session_conf('company_name'); ?>企业&nbsp;&nbsp;&nbsp;<button class="btn btn-info">公司缩写：<?php echo session_conf('company_name_s'); ?></button>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('login/logout'); ?>" class="btn btn-warning">退出</a>
  <p class="text-right">
    <span class="">公司编号：</span><?php echo session_conf('guid'); ?>
  </p>
</div>
<hr>
<p class="text-center">当天传播总人数：<?php echo $num; ?></p>
<hr>
<form action="" method="post" class="">
  <div class="row">
    <div class="form-group col-lg-5">
      <label class="sr-only" for="title"></label>
      <input class="form-control" name="title" required id="title" maxlength="15" placeholder="标题">
    </div>
    <div class="form-group col-lg-5">
      <label class="sr-only" for="link"></label>
      <input class="form-control" title="" name="link" id="link" value="" width="150" placeholder="跳转URL">
    </div>
    <div class="form-group col-lg-1">
      <button type="submit" class="btn btn-info" onClick="return cons('确认添加')">添加</button>
    </div>
  </div>
</form>
<hr>

<style type="text/css">
.link {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  width:100px;
}
</style>
<form action="/home/sort" method="post">
  <table class="table table-striped" style="table-layout:fixed">
    <thead>
      <tr>
        <th>编号</th>
        <th>标题</th>
        <th>累计传播人数</th>
        <th>阅读量</th>
        <th>链接地址</th>
        <th>在线时间</th>
        <th>创建时间</th>
        <th width="200px">操作</th>
      </tr>
    </thead>

    <tbody>
      <?php $i=1; foreach ($ret as $key => $value) {
      echo "<tr>";
        echo '<input type="hidden" name="sort[]" value="'.$value['guid'].'">';
        echo "<td>".$value['guid']."</td>";
        echo "<td>".$value['title']."</td>";
        echo "<td>".$value['baoguan_num']."</td>";
        echo "<td>".$value['click_num']."</td>";
        echo "<td class='link' width='300'>".$value['link']."</td>";
        echo "<td>".timeto($value['create_time'], date("Y-m-d H:i:s", time()))."</td>";
        echo "<td>".date("Y-m-d", strtotime($value['create_time']))."</td>";
        echo "<td>";
        echo "<a id='url' href='".site_url('home/del/'.$value['guid'])."' class='btn btn-danger btn-xs' onclick='return cons(\"确定删除\")'>删除</a>&nbsp;&nbsp;";
        echo "<a id='url' href='".site_url('home/edit/'.$value['guid'])."' class='btn btn-success btn-xs' onclick='return cons(\"确定编辑\")'>编辑</a>&nbsp;&nbsp;<hr style='margin-top:10px;margin-bottom:10px'>";
        if ($value['status'] == 1) {
          echo "<a id='url' href='".site_url('home/sw/'.$value['guid'])."/0' class='btn btn-danger btn-xs' onclick='return cons(\"确定暂停\")'>暂停</a>&nbsp;&nbsp;";
        } else {
          echo "<a id='url' href='".site_url('home/sw/'.$value['guid'])."/1' class='btn btn-success btn-xs' onclick='return cons(\"确定开启\")'>开启</a>&nbsp;&nbsp;";
        }
        echo "<button onClick='up($(this))' class='btn btn-success btn-xs up'>上移</button>&nbsp;&nbsp;";
        echo "<button class='btn btn-info btn-xs down'>下移</button>&nbsp;&nbsp;";
        echo "</td>";
      echo "</tr>";
      $i++; } ?>
    </tbody>
  </table>
  <hr>
  <p class="text-right">
    <input type="submit" class="btn btn-warning" value="保存排序">
  </p>
</form>
<script type="text/javascript">
function cons(info){
  if(!confirm(info + '?')) return false;
}
function up (obj) {
  console.log(obj)
  var p = obj.parent().parent()
  p.prev().before('<tr>'+p.html()+'</tr>')
  p.remove()
  console.log(p.html());
}
</script>