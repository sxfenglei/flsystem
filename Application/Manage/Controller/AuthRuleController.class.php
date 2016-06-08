<?php
/**
 * 权限规则控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
class AuthRuleController extends BaseController {
    //权限规则列表
    public function index(){
        $this->assign('list',D('AuthRule')->getList(true,array('status'=>array('egt',0))));
        $this->display('Auth/authRule');
    } 
    //新增权限规则
    public function add(){
        $data['name'] = I('name');//$_POST;
        $data['title'] = I('title');
        $data['parent_id'] = I('parentId');
        $data['condition'] = I('condition');

        if(empty($data['name']) || empty($data['title'])){
            showReturn(10000,'请求数据不可为空');
        }
        //规则以"/"开头
        if(!preg_match("/^\//",$data['name'])){
            $data['name'] = '/'.$data['name'];
        }
        //规则以"/"结尾
        if(!preg_match("/\/$/", $data['name'])){
            $data['name'] = $data['name'].'/';
        }
        $data['type'] = 1;
        $data['status'] = 1;

        if(D('AuthRule')->add($data)){
            showReturn(0,'添加成功');
        }else{
            showReturn(10101,'添加失败');
        }
    }
    //编辑权限规则
    public function edit(){
        $id = I('id');
        $data['name'] = I('name');//$_POST;
        $data['title'] = I('title');
        $data['parent_id'] = I('parentId');
        $data['condition'] = I('condition');

        if(empty($id)){
            showReturn(10010,'请求参数错误');
        }
        if(empty($data['name']) || empty($data['title'])){
            showReturn(10000,'请求数据不可为空');
        }
        //规则以"/"开头
        if(!preg_match("/^\//",$data['name'])){
            $data['name'] = '/'.$data['name'];
        }
        //规则以"/"结尾
        if(!preg_match("/\/$/", $data['name'])){
            $data['name'] = $data['name'].'/';
        }

        if(false !== D('AuthRule')->where(array('id'=>array('eq',$id)))->save($data)){
            showReturn(0,var_export($data,true).'修改成功'.D()->getLastSql());
        }else{
            showReturn(10101,'修改失败');
        }
    }

  

}
