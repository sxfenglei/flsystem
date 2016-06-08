<?php
/**
 * 权限配置
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
return array(
	//权限验证设置
	'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, 		//认证开关
        'AUTH_TYPE' => 1, 		// 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'fl_auth_group', 				//用户组数据表
        'AUTH_GROUP_ACCESS' => 'fl_auth_group_access', 	//用户组拥有的权限表
        'AUTH_RULE' => 'fl_auth_rule', 					//权限规则表
        'AUTH_USER' => 'fl_manage'						//用户信息表
    ),
    //指定拥有全部权限的超级管理员id.可以设置多个值,如array('1','2','3'),
    'ADMINISTRATOR'=>array('1'),
);
