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

  <!--[if lt IE 9]>
  <script src="/Public/lteplus/dist/js/html5shiv.min.js"></script>
  <script src="/Public/lteplus/dist/js/respond.min.js"></script>
  <![endif]-->
  

</head>
<?php $manage_info = json_decode($_SESSION['MANAGE_INFO'],true); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- 顶端菜单 -->
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <span class="logo-mini"><?php echo (C("developer.company")); ?></span>
      <span class="logo-lg"><?php echo (C("developer.company")); ?>管理平台</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i> 清理缓存</a>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/Public/lteplus/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $manage_info['login_name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/Public/lteplus/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                <?php echo $manage_info['real_name']; ?>
                  <small><?php echo $manage_info['phone']; ?></small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">修改信息</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo U('Public/logout');?>" class="btn btn-default btn-flat">退出</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header><!-- /顶端菜单 -->



  <!-- 左侧菜单 -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <?php if(CONTROLLER_NAME == 'Index'): ?><li class="active">
        <?php else: ?>
          <li><?php endif; ?>
          <a href="<?php echo U('Index/index');?>">
            <i class="fa fa-link"></i>
            <span> 主页面 </span>
          </a>
        </li>

        <?php if(CONTROLLER_NAME == 'Setting'): ?><li class="active">
        <?php else: ?>
          <li><?php endif; ?>
          <a href="#">
            <i class="fa fa-link"></i>
            <span> 基本设置 </span>
          </a>
        </li>

        <?php if(CONTROLLER_NAME == 'AuthRule' or CONTROLLER_NAME == 'AuthGroup'): ?><li class="treeview active">
        <?php else: ?>
          <li class="treeview"><?php endif; ?>
          <a href="#">
            <i class="fa fa-link"></i>
            <span> 权限管理 </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if(CONTROLLER_NAME == 'AuthRule'): ?><li class="treeview active">
            <?php else: ?>
              <li class="treeview"><?php endif; ?>
              <a href="<?php echo U('AuthRule/index');?>">权限规则</a>
            </li>

            <?php if(CONTROLLER_NAME == 'AuthGroup'): ?><li class="treeview active">
            <?php else: ?>
              <li class="treeview"><?php endif; ?>
              <a href="<?php echo U('AuthGroup/index');?>">角色权限</a>
            </li>
          </ul>
        </li>

      </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
  </aside><!-- /左侧菜单 -->





  <!-- 主内容区域 -->
  <div class="content-wrapper">
    <!-- 内容区头部 -->
    <section class="content-header">
      <div style="text-align: left;">
        <ol class="breadcrumb">
          
<li><a href="<?php echo U('Index/index');?>"><i class="fa fa-dashboard"></i> 主页面</a></li>
<li class="active">修改角色</li>

        </ol>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
    
<form action="<?php echo U('AuthGroup/authGroupEdit');?>" method="post">
<!-- Input -->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">角色名称</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
          <input type="text" name="title" required="required" title="角色名称不可为空" value="<?php echo ($list["title"]); ?>" class="form-control" placeholder="请填写角色名称">
      </div>
      <div class="col-md-4">
        应用管理员角色名称
      </div>
    </div>
    <br> 

    <h4>选择权限</h4>
    <div class="row">
      <div class="col-md-6 quanxian">
          <table class="table table-bordered"> 
                <?php foreach($authRuleList as $key=>$val){ $tag = ''; foreach($authRule as $k=>$v){ if($val['id'] == $v){ $tag = 'checked'; } } echo '<tr><td>'.$val['html'].'<input type="checkbox" value="'.$val['id'].'" data-str="'.$val['title'].'" '.$tag.'/>'.$val['title'].'</td></tr>'; } ?> 
            </table> 
      </div>
      <div class="col-md-4">
        
      </div>
    </div>
    <br>
 
    </div>
    <hr>

    <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>">
    <input type="hidden" name="authRuleIds" id="authRuleIds" value="<?php echo ($list["rules"]); ?>">
    <input type="hidden" name="authRuleStr" id="authRuleStr" value="<?php echo ($list["rules_str"]); ?>">
 
    <div class="row">
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary">编辑</button>
          <a href="javascript:history.go(-1)" class="btn btn-default">返回</a>
      </div>
      <div class="col-md-4">
        
      </div>
    </div>
    <br>
   
  </div><!-- /.box-body -->
</div><!-- /.box --> 
</form> 

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->




  <!-- 页脚 -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; 2016 <a href="<?php echo (C("developer.http")); ?>"  target="_blank"><?php echo (C("developer.footer")); ?></a>.</strong> All rights reserved.
  </footer><!-- /页脚 -->

  
</div><!-- ./wrapper -->
<script src="/Public/Js/jQuery-2.2.0.min.js"></script>
<script src="/Public/lteplus/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/lteplus/dist/js/app.min.js"></script>
 
<script type="text/javascript"> 
$(function(){
  $('input[type="checkbox"]').on("click",function(){
    var arIds = new Array();
    var arStr = new Array();
    $('.quanxian').find('input[type="checkbox"]:checked').each(function(k,v){
      arIds.push($(v).val());
      arStr.push($(v).data("str"));
    });
    $('#authRuleIds').val(arIds.join(","));
    $('#authRuleStr').val(arStr.join(","));
  });
});
</script>

</body>
</html>