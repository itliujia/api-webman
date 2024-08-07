<?php

use support\Request;

return [
    'debug' => true, // 是否开启调试模式
    'error_reporting' => E_ALL, // 设置应该报告何种 PHP 错误
    'default_timezone' => 'Asia/Shanghai', // 默认时区
    'request_class' => Request::class, // 请求类
    'public_path' => base_path() . DIRECTORY_SEPARATOR . 'public', // 静态资源目录
    'runtime_path' => base_path(false) . DIRECTORY_SEPARATOR . 'runtime', // 运行时目录
    'controller_suffix' => 'Controller', // 控制器后缀
    'controller_reuse' => false, // 是否复用控制器实例
];

