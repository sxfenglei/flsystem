<?php
/**
 * 基类控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
use Think\Log;
class BaseController extends Controller {
	public function _initialize(){
		if(!isset($_SESSION['MANAGE_INFO'])){
			$this->redirect('Public/login');
		}
	}
    protected function _empty(){
        echo '请求的'.ACTION_NAME.'不存在';
    }

}
