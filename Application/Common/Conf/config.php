<?php
/**
 * 配置
 * @author sxfenglei
 * @email sxfenglei@vip.qq.com
 * @github https://github.com/sxfenglei/flsystem
 */
return array(
	'MODULE_ALLOW_LIST' => array ('Manage','Home','Wap'),
    'DEFAULT_MODULE'     => 'Home', //默认模块

    'PAGE_NUM'=>10,//分页

	'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	'HTML_CACHE_TIME'   =>    7200,   // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.html', // 设置静态缓存文件后缀

	'LOAD_EXT_CONFIG'   => 'info,db,auth', //权限
);
