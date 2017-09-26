<?php

namespace Addons\Comment\Model;
use Think\Model;

/**
 * Comment模型
 */
class CommentModel extends Model{
	protected $_auto = array(
		array('update_time', NOW_TIME, self::MODEL_BOTH),
		array('yz', 1, self::MODEL_BOTH),
	);
    public $model = array(
        'title'=>'',//新增[title]、编辑[title]、删除[title]的提示
        'template_add'=>'',//自定义新增模板自定义html edit.html 会读取插件根目录的模板
        'template_edit'=>'',//自定义编辑模板html
        'search_key'=>'',// 搜索的字段名，默认是title
        'extend'=>1,
    );

    public $_fields = array(
        'id'=>array(
            'name'=>'id',//字段名
            'title'=>'ID',//显示标题
            'type'=>'num',//字段类型
            'remark'=>'',// 备注，相当于配置里的tip
            'is_show'=>3,// 1-始终显示 2-新增显示 3-编辑显示 0-不显示
            'value'=>0,//默认值
        ),
        'title'=>array(
            'name'=>'content',
            'title'=>'评论内容',
            'type'=>'string',
            'remark'=>'',
            'is_show'=>1,
            'value'=>0,
            'is_must'=>1,
        ),
    );
}
