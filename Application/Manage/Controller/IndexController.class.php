<?php
/**
 * 首页控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $this->display();
    }
    //修改密码
    public function alterPwd(){
    	if(IS_POST){
    		$oldPwd = I('oldPwd');
    		$newPwd = I('newPwd');
    		$reNewPwd = I('reNewPwd');
    		if(empty($oldPwd)||empty($newPwd)){
    			$this->error('必填项不可为空');
    		}
    		if($newPwd != $reNewPwd){
    			$this->error('两次密码不相逢');
    		}

    		$manageinfo = json_decode($_SESSION['MANAGE_INFO'],true); 
			$resManage = D('Manage')->where(array('login_name'=>array('eq',$manageinfo['login_name'])))->find();
			//验证用户
			if(pwdEncrypt($oldPwd,$resManage['salt']) != $resManage['login_pwd']){
				$this->error('原始密码不正确');
			}

    		if(D('Manage')->alterPwd($resManage,$oldPwd,$newPwd)){
        		session_destroy();
    			$this->success('修改成功');
    		}else{
    			$this->error('修改失败');
    		}
    	}else{
    		$this->display();
    	}
    }
}
