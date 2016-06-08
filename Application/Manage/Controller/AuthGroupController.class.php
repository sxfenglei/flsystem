<?php
/**
 * 权限角色控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
class AuthGroupController extends BaseController {
    //权限角色列表
    public function index(){
		$list = D('AuthGroup')->getPageList();
		$this->assign('authGroupList',$list);
        $this->display('Auth/authGroup');
    }  

    public function authGroupAdd(){
        if(IS_POST){
            $postData = $_POST;
            if(empty($postData['title'])){
                showReturn(10000,'角色名不可为空');
            }
            $data['title'] = $postData['title'];
            $data['status'] = 1;
            $data['rules'] = $postData['authRuleIds'];
            $data['rules_str'] = $postData['authRuleStr'];

            if(D('AuthGroup')->add($data)){
                $this->success('创建成功',U('AuthGroup/authGroup'));
            }else{
                $this->error('创建失败');
            }

        }else{
            $this->assign('authRuleList',D('AuthRule')->getList(true));
            $this->display('Auth/authGroupAdd');
        }
    }

    public function authGroupEdit(){
        $id = I('id');
        if(IS_POST){
            $postData = $_POST;
            if(empty($postData['title'])){
                showReturn(10000,'角色名不可为空');
            }
            $data['title'] = $postData['title'];
            // if(empty($postData['authRuleIds'])){
                $data['rules'] = $postData['authRuleIds'];
            // }
            // if(empty($postData['authRuleStr'])){
                $data['rules_str'] = $postData['authRuleStr'];
            // }

            if(false !== D('AuthGroup')->where(array('id'=>array('eq',$id)))->save($data)){
                $this->success('修改成功',U('AuthGroup/authGroup'));
            }else{
                $this->error('修改失败');
            }

        }else{
            $list = D('AuthGroup')->where(array('id'=>array('eq',$id)))->find();
            $this->assign('list',$list); 
            $this->assign('authRuleList',D('AuthRule')->getList(true));
            $this->assign('authRule',explode(",", $list['rules']));
            $this->display('Auth/authGroupEdit');
        }
    } 
 
}
