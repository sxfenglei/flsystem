<?php
/**
 * 公共基类模型
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Common\Model;
use Think\Model;
class CommonModel extends Model {
	/**
	* 自动完成
	*/
	protected $_auto = array(
		array('update_time','time',2,'function'),
		array('create_time','time',1,'function'),
	);

	/**
	* 获取分页数据
	*/
	public function getPageList($map=array('status'=>array('egt',0)),$sort="create_time desc"){
		$res['list'] = $this->where($map)->page($_GET['p'],C('PAGE_NUM'))->select();
		// $res['list'] = $this->where($map)->limit(C('PAGE_NUM'))->page($_GET['p'])->select();
		$count = $this->where($map)->count();
		$page = new \Think\Page($count,C('PAGE_NUM'));
		$res['show'] = $page->show();
		return $res;
	}

	/**
	* 获取所有数据
	* $isTree 是否返回tree数据
	*/
	public function getList($isTree=false,$map=array(),$sort=''){
			if(count($map)<1){	
				$map['status'] = array('eq',1);
			}
			$res = $this->where($map)->order($sort)->select();
			if($isTree){
				return convertTree($res);
			}
			return $res;
	}
	
	/**
	* 获取所有数据树
	*/
	public function getTree($map=array()){
			if(count($map)<1){
				$map['parent_id'] = array('eq',0);
				$map['status'] = array('eq',1);
			}
			$rootRes = $this->where($map)->select();
			$where['status'] = array('eq',1);
			$where['parent_id'] = array('eq',$rootRes[0]['id']);
			$res = $this->where($where)->select();
			return convertTree(array_merge($rootRes,$res));
	}


}
