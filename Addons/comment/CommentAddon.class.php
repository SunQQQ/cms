<?php

namespace Addons\Comment;
use Common\Controller\Addon;
use Think\Model;

/**
 * 评论插件
 * @author tpcms
 */

    class CommentAddon extends Addon{

        public $info = array(
            'name'=>'Comment',
            'title'=>'评论',
            'description'=>'文章评论插件',
            'status'=>1,
            'author'=>'tpcms',
            'version'=>'0.1'
        );

        public $admin_list = array(
            'model'=>'Comment',		//要查的表
			'fields'=>'*',			//要查的字段
			'map'=>'',				//查询条件, 如果需要可以再插件类的构造方法里动态重置这个属性
			'order'=>'id desc',		//排序,
			'list_grid'=>array( 		//这里定义的是除了id序号外的表格里字段显示的表头名和模型一样支持函数和链接
                'aid:文章编号',
                'username:昵称',
                'ip:IP地址',
                'content:内容',
                'update_time|time_format:更新时间',
                'id:操作:[EDIT]|编辑,[DELETE]|删除'
            ),
        );

        public function install(){
			//读取SQL文件
			$sql = file_get_contents(__DIR__.'/data.sql');
			$sql = str_replace("\r", "\n", $sql);
			$sql = explode(";\n", $sql);
			$md = new Model();
			
			foreach ($sql as $value) {
				$value = trim($value);
				if(empty($value)) continue;
				$md->execute($value);
		}
            return true;
        }

        public function uninstall(){
			//删除数据表
			$md =new Model();
			$sql = 'DROP TABLE IF EXISTS `onethink_comment`';
			$md->execute($sql);
			M('hooks')->where(array('name'=>'aritcleComment',))->delete();
            return true;
        }

        //实现的aritcleComment钩子方法
        public function aritcleComment($param){
            $config = $this->getConfig();
			if($config['open'])
			{
				$config['logined'] = is_login();
            	$listdb = M('Comment')->select();
            	$this->assign('addons_config',$config);
           		$this->assign('listdb',$listdb);
                        
            	if($config['open'])
               		$this->display('widget');
			}
        }	

    }