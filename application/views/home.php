<?php
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
<div class="alert alert-info"><?php echo session_conf('company_name'); ?>企业，添加内容&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('login/logout'); ?>" class="btn btn-warning">退出</a></div>
<hr>
<form action="" method="post" class="">
  <div class="row">
    <div class="form-group col-lg-5">
      <label class="sr-only" for="title"></label>
      <input class="form-control" name="title" required id="title" maxlength="15" placeholder="标题">
    </div>
    <div class="form-group col-lg-5">
      <label class="sr-only" for="link"></label>
      <input class="form-control" title="" name="link" id="link" value="" width="150" placeholder="URL链接地址">
    </div>
    <div class="form-group col-lg-1">
      <button type="submit" class="btn btn-info" onClick="return cons('确认添加')">添加</button>
    </div>
  </div>
</form>
<hr>


<table class="table table-striped">
  <thead>
    <tr>
      <th>编号</th>
      <th>标题</th>
      <th>曝光用户量</th>
      <th>阅读量</th>
      <th>在线时间</th>
      <th>创建时间</th>
      <th width="100px">操作</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($ret as $key => $value) {
    echo "<tr>";
      echo "<td>".$value['id']."</td>";
      echo "<td>".$value['title']."</td>";
      echo "<td>".$value['baoguan_num']."</td>";
      echo "<td>".$value['click_num']."</td>";
      echo "<td>".timeto($value['create_time'], date("Y-m-d H:i:s", time()))."</td>";
      echo "<td>".date("Y-m-d", strtotime($value['create_time']))."</td>";
      echo "<td>";
      echo "<a id='url' href='".site_url('home/del/'.$value['id'])."' class='btn btn-danger btn-xs' onclick='return cons(\"确定删除\")'>删除</a>&nbsp;&nbsp;";
      echo "<a id='url' href='".site_url('home/edit/'.$value['id'])."' class='btn btn-success btn-xs' onclick='return cons(\"确定编辑\")'>编辑</a>";
      echo "</td>";
    echo "</tr>";
    $i++; } ?>
  </tbody>
</table>
<script type="text/javascript">
function cons(info){
  if(!confirm(info + '?')) return false;
}
</script>