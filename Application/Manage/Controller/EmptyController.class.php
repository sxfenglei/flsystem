<?php
/**
 * 空控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
class EmptyController extends Controller{
  
    protected function _empty(){
        $this->error('错误的'.CONTROLLER_NAME.'请求');
    }
}
