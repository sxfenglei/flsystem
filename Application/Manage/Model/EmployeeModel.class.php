<?php
/**
 * 管理员员工表模型
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Model;
use Common\Model\CommonModel;
class EmployeeModel extends CommonModel {
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
 
	/**
	* 手机号查询是否重复
	*/
	public function isRepetition($phone){
		return $this->where(array('phone'=>array('eq',$phone),'status'=>array('egt',0)))->find();
	}
}
