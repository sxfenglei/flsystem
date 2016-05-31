<?php
/**
 * 权限-角色表模型
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Model;
use Common\Model\CommonModel;
class AuthGroupModel extends CommonModel {
	protected $_auto = array(
		array('status','0'),
		array('update_time','time',2,'function'),
		array('create_time','time',1,'function'),
	);
	public function getList(){
		return $this->select();
	}
	//树结构
	//$tree = getTree($data, 0);
	public function getTree($data, $pId){
		$tree = '';
		foreach($data as $k => $v){
		   if($v['parent_id'] == $pId){         //父亲找到儿子
			$v['sub_tree'] = $this->getTree($data, $v['id']);
			$tree[] = $v;
			//unset($data[$k]);
		   }
		}
		return $tree;
	}
	//树结构HTML
	//echo procHtml($tree);
	// public function procHtml($tree){
	// 	$html = '';
	// 	foreach($tree as $t){
	// 	   if($t['sub_tree'] == ''){
	// 	    $html .= "<tr><td>{$t['title']}<td><td>删除</td></tr>";
	// 	   }else{
	// 	    $html .= "<tr><td>".$t['title'];
	// 	    $html .= $this->procHtml($t['sub_tree']);
	// 	    $html = $html."</td></tr>";
	// 	   }
	// 	}
	// 	return $html ? '<table class="table table-bordered">'.$html.'</table>' : $html ;
	// }
	public function procHtml($tree){
		$html = '';
		foreach($tree as $t){
		   if($t['sub_tree'] == ''){
		    $html .= "<li>{$t['title']} {$t['name']}&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onclick='del(".$t['id'].")' style='font-size:0.7rem'>删除</a></li>";
		   }else{
		    $html .= "<li>".$t['title'];
		    $html .= $this->procHtml($t['sub_tree']);
		    $html = $html."</li>";
		   }
		}
		return $html ? '<ul>'.$html.'</ul>' : $html ;
	}

}
