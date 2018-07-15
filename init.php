<?php
    /*
     * 项目配置文件
     * */
    @session_start();
    date_default_timezone_set('PRC');//设置相应头编码
    header('Content-Type:text/html;charset=utf-8');  //设置字符编码
    define("DIR_ROOT",str_replace('\\','/',__DIR__).'/');//定义根目录常量
    define("DIR_PUBLIC",'/public'); //定义公共文件目录常量
?>