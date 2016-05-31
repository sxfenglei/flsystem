<?php
/**
 * 权限控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
class AuthController extends BaseController {
	
    //=======================================================
    //权限 角色
    //------------------
    public function authList(){
        $data = D('AuthRule')->getList();
        // echo json_encode(getCategoryTree($data));//另一种方式
        $tree = D('AuthRule')->getTree($data,0);
        $this->assign('authRuleList',D('AuthRule')->procHtml($tree));
        $str='';
        $this->getTreeData($tree,arrayLevel($tree),$str);
        $this->assign('selectParentId',$str);
        unset($str);
        $this->display();
    }

    public function getTreeData($tree,$n,&$str){
        foreach($tree as $k=>$t){
            // echo $t['name'].'<br>';
            $num = intval($n) - intval(arrayLevel($t));
            $str .= '<option value="'.$t['id'].'">'.$this->nbsp($num).'|-'.$t['title'].' '.$t['name'].'</option>';
            if(isset($t['sub_tree'])){
                $this->getTreeData($t['sub_tree'],$n,$str);
            }
        }
    }
    public function nbsp($n){
        $str = '';
        for ($i=0; $i < $n; $i++) {
            $str .= '&nbsp;';
        }
        return $str;
    }

    //新增
    public function authRuleAdd(){
        $postData = $_POST;
        if(empty($postData['name']) || empty($postData['title'])){
            showReturn(10000,'请求数据不可为空');
        }
        if(!preg_match("/^\//",$postData['name'])){
            $postData['name'] = '/'.$postData['name'];
        }
        if(!preg_match("/\/$/", $postData['name'])){
            $postData['name'] = $postData['name'].'/';
        }
        $data['parent_id'] = $postData['parentId'];
        $data['name'] = $postData['name'];
        $data['title'] = $postData['title'];
        $data['type'] = 1;
        $data['status'] = 1;

        if(D('AuthRule')->add($data)){
            showReturn(0,'添加成功');
        }else{
            showReturn(10101,'添加失败');
        }
    }


    //删除
    public function del(){
        $id = I('id');
        if(empty($id)){
            showReturn(10001,'请求参数错误');
        }
        if( D('AuthRule')->delete($id) ){
            showReturn(0,'删除成功');
        }else{
            showReturn(10101,'删除失败');
        }
    }
        //角色
    //------------------
    public function authGroupList(){
            $list = D('AuthGroup')->getPageList();
            $this->assign('authGroupList',$list);
            $this->assign('pStr',C('PAGE_NUM')*($list['p']-1));
            $this->display();
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
                $this->success('创建成功',U('Auth/authGroupList'));
            }else{
                $this->error('创建失败');
            }

        }else{
            $data = D('AuthRule')->getList();
            $tree = D('AuthRule')->getTree($data,0);
            $this->assign('authRuleList',D('AuthRule')->procHtml2($tree));
            $this->display();
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
                $this->success('创建成功',U('Auth/authGroupList'));
            }else{
                $this->error('创建失败');
            }

        }else{
            $list = D('AuthGroup')->where(array('id'=>array('eq',$id)))->find();
            $this->assign('list',$list);
            $data = D('AuthRule')->getList();
            $tree = D('AuthRule')->getTree($data,0);
            $arr = explode(",", $list['rules']);
            $this->assign('authRuleList',D('AuthRule')->procHtml3($tree,$arr));
            $this->display();
        }
    }

    public function authGroupDel(){
        $id = I('id');
        if(empty($id)){
            showReturn(10001,'请求参数错误');
        }
        if( D('AuthGroup')->delete($id) ){
            showReturn(0,'删除成功');
        }else{
            showReturn(10101,'删除失败');
        }
    }




}
