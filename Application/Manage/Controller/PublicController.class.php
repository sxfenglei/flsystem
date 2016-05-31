<?php
/**
 * 公开控制器
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
namespace Manage\Controller;
use Think\Controller;
use Think\Log;
class PublicController extends Controller {
    protected function _empty(){
        echo '请求的'.ACTION_NAME.'不存在';
    }

    public function verify(){
        ob_clean();
        $verify = new \Think\Verify();
        $Verify->useImgBg = true;
        $verify->entry();
    }

	public function login(){
		if(IS_POST){
            $loginName = I('post.loginName');
            $loginPwd = I('post.loginPwd');
            $verifyCode = I('post.verifyCode');

            if(!check_verify($verifyCode)){
                $this->error('验证码错误');
            }

            if(empty($loginName) || empty($loginPwd)){
                $this->error('登录信息不可为空');
            }

            try {
                $mManage = D('Manage');
                $resManage = $mManage->login($loginName,$loginPwd);
                if($resManage){
                    if($resManage['status'] == 0){
                        $this->error('账号已被禁用');
                    }else if($resManage['status'] == 1){
                        unset($resManage['login_pwd']);
                        unset($resManage['salt']);
                        session('MANAGE_INFO',json_encode($resManage));
                        $this->success('登录成功');
                    }else{
                        Log::write('['.date('Y-m-d H:i:s',time()).']'.'登录失败resManage='.var_export($resManage,true));
                        Log::write('登录失败session='.var_export($_SESSION,true));
                        $this->error('登录失败');
                    }
                }else{
                    $this->error('登录名或密码错误');
                }
            } catch (Exception $e) {
                Log::write('['.date('Y-m-d H:i:s',time()).']'.$e->getMessage());
                $this->error('数据库异常');
            }
		}else{
            if(isset($_SESSION['MANAGE_INFO'])){
                $this->redirect('Index/index');
            }
			$this->display();
		}
	}

    public function logout(){
        session('MANAGE_INFO',null);
        if(isset($_SESSION['MANAGE_INFO']) ){
            unset($_SESSION['MANAGE_INFO']);
        }
        session_destroy();
        $this->redirect('Index/index');
    }
}
