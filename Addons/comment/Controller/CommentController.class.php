<?php

namespace Addons\Comment\Controller;
use Home\Controller\AddonsController;
use User\Api\UserApi;

class CommentController extends AddonsController{
	//验证码生成
	public function verify(){
    $verify = new \Think\Verify();
    $verify->entry(1);
	}
	
	//提交评论
	public function subcomment()
	{
		$username = I('post.username');
		$password = I('post.password');
		$verify = I('post.verify');
		$comment = I('post.comment');
        $aid = I('post.aid');
        $cid = I('post.cid');
		$checkimg = I('post.checkimg');

		$data[status] = true;
		$data[message]='评论成功！';
		if(IS_POST){
            //验证用户账号和验证码
			if(!is_login()){         

            /* 调用UC登录接口登录 */
            $User = new UserApi;
            $uid = $User->login($username, $password);
            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = D('Member');
                if($Member->login($uid)){ //登录用户
                    //TODO:跳转到登录前页面
					$data[message] = '登录成功！';
                } else {
                    $data[message] = '登录失败！';
					$data[status] = false;
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $data[message] = $error;
				$data[status] = false;
            }}

            /* 检测验证码 TODO: */
            if($checkimg && !check_verify($verify)){
                $data[message] = '验证码输入错误！';
                $data[status] = false;
            }else{
            $user = session('user_auth');
            $db = M('Comment');
            $data[content] = $comment;
            $data[uid] = $user[uid];
            $data[username] = $user[username];
            $data[yz] = 1;
            $data[ip] = get_client_ip(0);
            $data[aid] = $aid;
            $data[cid] = $cid;
			$data[update_time] = time();
            $db->add($data);
			$data[update_time] = time_format($data[update_time],'Y-m-d');
			}
        } 
		$this->ajaxReturn($data);		
	}
}
