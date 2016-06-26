<div class="alert"></div>
<form action="" method="post" class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="string" required class="form-control" name="username" placeholder="用户名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">公司名称</label>
    <div class="col-sm-10">
      <input type="string" required class="form-control" name="company" placeholder="公司名称">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">公司类别</label>
    <div class="col-sm-10">
      <input type="string" required class="form-control" name="category" placeholder="公司类别">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">公司名称缩写</label>
    <div class="col-sm-10">
      <input type="string" required class="form-control" maxlength="4" name="company_s" placeholder="公司名称缩写，只能填写四个字">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" required class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password1" placeholder="请输入密码">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
      <input type="password" required class="form-control" name="password2" placeholder="请再次输入密码">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">注册</button>
      <a href="<?php echo site_url('login'); ?>" class="btn btn-success">登陆</a>
    </div>
  </div>
</form>