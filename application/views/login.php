<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=EDGE,chrome=1">
<meta name="viewport" content="width=320, initial-scale=1.0">
<title>管理系统-用户登录</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/login.css"/>
</head>
<body id="loginPage">
  <div class="loginSection">

    <div id="message_container"></div>
    <form action="" name="login_form" id="login_form" method="post">
      <h1>管理系统</h1>
      <div class="inputs">
        <input type="text" name="username" id="login_form_login"
          class="input" value="" size="20" tabindex="10"
          placeholder="用户名" autofocus="autofocus" /> <input
          type="password" name="password" id="login_form_password"
          class="input" value="" size="20" tabindex="20"
          placeholder="密码" />
      </div>

      <div class="actions">
        <input class="submit" id='login_form_submit' type="submit" value="登录" tabindex="100" />
        <a href="<?php echo site_url('register') ?>" class="submit" id='login_form_submit' style="" tabindex="100">注册</a>
      </div>
    </form>
  </div>
</body>
</html>