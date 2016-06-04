<div class="alert"></div>
<form action="" method="post" class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">公司缩写</label>
    <div class="col-sm-10">
      <input type="string" class="form-control" placeholder="<?php echo $ret['company_name_s'] ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-10">
      <input type="string" class="form-control" value="<?php echo $ret['title'] ?>" name="title" placeholder="标题">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">链接地址</label>
    <div class="col-sm-10">
      <input type="string" class="form-control" value="<?php echo $ret['link'] ?>" name="link" placeholder="链接地址">
      <input type="hidden" name="id" value="<?php echo $ret['info_id'] ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">保存修改</button>
      <a href="<?php echo site_url('home'); ?>" class="btn btn-success">返回</a>
    </div>
  </div>
</form>