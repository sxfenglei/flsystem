<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>后台管理平台 | <?php echo (C("developer.company")); ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/Public/lteplus/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/Public/lteplus/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/Public/lteplus/dist/css/skins/skin-blue.min.css">
  <!-- <link rel="stylesheet" href="/Public/lteplus/dist/css/skins/skin-black-light.min.css">-->
  <link rel="stylesheet" href="/Public/lteplus/plugins/iCheck/square/blue.css">

  <!--[if lt IE 9]>
  <script src="/Public/lteplus/dist/js/html5shiv.min.js"></script>
  <script src="/Public/lteplus/dist/js/respond.min.js"></script>
  <![endif]-->
</head>
 <body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b></b>FL后台管理平台</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">应用从这里开始</p>

    <form action="<?php echo U('Public/login');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="loginName" name="loginName" class="form-control" placeholder="登录名">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="loginPwd" name="loginPwd" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <input type="text" id="verifyCode" name="verifyCode" class="form-control">
        </div>
        <div class="col-xs-8">
          <img id="verifyImg" style="cursor:pointer;width:207px;"  src='<?php echo U("Public/verify");?>' />
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xs-6">
          <button type="submit" id="loginBtn" class="btn btn-primary btn-block btn-flat">登 录</button>
        </div>
        <!-- /.col -->
      </div>
    </form> 
    <!-- /.social-auth-links -->

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
 
  <div style="text-align: center;width: 20rem;margin: 0 auto;background-color: rgba(255,255,255,0.5);padding: 1rem;border-radius: 0.5rem;">
    <p>技术支持 @ <?php echo (C("developer.company")); ?></p>
  </div> 
<script src="/Public/Js/jQuery-2.2.0.min.js"></script>
<script src="/Public/lteplus/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/lteplus/dist/js/app.min.js"></script>
<script>
$(function () {

  //验证码
  $('#verifyImg').click(function(){
    var random = Math.random();
    var url = "<?php echo U('Public/verify');?>";
    $(this).attr('src',url);
  });

});// /function


</script>
</body>
</html>