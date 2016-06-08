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
    	$this->error('请求的'.ACTION_NAME.'不存在');
    }

    /**
    * 公共状态修改
    */
    public function changeStatus(){
    	$id = I('id');
    	$v = I('v');
    	$model = M(CONTROLLER_NAME);
    	if(empty($model)){
    		showReturn(10010,'数据库异常');
    	}
    	$data['status'] = $v;
    	$res = $model->where(array('id'=>array('eq',$id)))->save($data);
    	if($res){
    		showReturn(0,'操作成功');
    	}else{
    		showReturn(10100,'操作失败');
    	} 
    }

    /**
    * 公共虚拟删除
    */
    public function virtualDel(){
    	$id = I('id');
    	$model = M(CONTROLLER_NAME);
    	if(empty($model)){
    		showReturn(10010,'数据库异常');
    	}
    	$data['status'] = -1;
    	$res = $model->where(array('id'=>array('eq',$id)))->save($data);
    	if($res){
    		showReturn(0,'删除成功');
    	}else{
    		showReturn(10100,'删除失败');
    	}
    }

    /**
    * 公共删除
    */
    public function del(){
    	$id = I('id');
    	$model = M(CONTROLLER_NAME);
    	if(empty($model)){
    		showReturn(10010,'数据库异常');
    	}
    	$res = $model->where(array('id'=>array('eq',$id)))->delete($id);
    	if($res){
    		showReturn(0,'删除成功');
    	}else{
    		showReturn(10100,'删除失败');
    	}
    }



}
