<?php
/**
 * 超级管理员表模型
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Model;
use Common\Model\CommonModel;
class ManageModel extends CommonModel {
	/**
	* 登录验证
	*/
	public function login($login_name,$login_pwd){
		if(!isset($login_name)||!isset($login_pwd)){
			return false;
		}

		$resManage = $this->where(array('login_name'=>array('eq',$login_name)))->find();
		if(!$resManage){
			return false;
		}

		//登录成功
		if(pwdEncrypt($login_pwd,$resManage['salt']) == $resManage['login_pwd']){
			return $resManage;
		}else{
			return false;
		}
	}
}
