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
                  <a href="<?php echo U('Index/alterPwd');?>" class="btn btn-default btn-flat">修改信息</a>
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
<li class="active">角色列表</li>

        </ol>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
    
<div class="row">
  <div class="col-md-2">
    <a href="<?php echo U('AuthGroup/authGroupAdd');?>" ="" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> 新增角色</a>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">

          <div class="box">
            <div class="box-header with-border">
           <!--    <form action="<?php echo U('Admin/adminList');?>" method="get">
                <div class="row">
                  <div class="col-md-1">支持模糊查询</div>
                  <div class="col-md-2">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" name="search" value="<?php echo ($_GET['search']); ?>" placeholder="请输入手机号或者姓名">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-search">搜索</button>
                          </span>
                    </div>
                  </div>
                </div>
              </form> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table class="table table-bordered">
                  <tr>
                    <th style="width: 5rem">编号</th>
                    <th>角色名称</th>
                    <th>拥有权限</th>
                    <th style="width: 15rem">操作</th>
                  </tr>
                  <?php if(is_array($authGroupList["list"])): $i = 0; $__LIST__ = $authGroupList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["title"]); ?></td>
                    <td><?php echo ($vo["rules_str"]); ?></td>
                    <td>
                      <div class="btn-group">
                          <a href="<?php echo U('AuthGroup/authGroupEdit',array('id'=>$vo['id']));?>" class="btn btn-success">编辑</a>
                          <button type="button" onclick="delFun(<?php echo ($vo["id"]); ?>)" class="btn btn-danger">删除</button>
                      </div>
                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
              </div>
              
            <div class="box-footer clearfix">
              <?php echo ($list["show"]); ?>
            </div>

            </div>

  </div><!-- /.col -->
</div><!-- /.row -->

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
function delFun(id){
  if(!confirm('确认删除吗?')){
    return false;
  }
  $.post("<?php echo U('AuthGroup/virtualDel');?>",{'id':id},function(data){
    if(data.code == 0){
      window.location.reload();
    }else if(data.msg != 'undefined'){
      alert(data.msg);
    }else{
      alert('系统繁忙');
    }
  });
}
</script>

</body>
</html>