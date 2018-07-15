<?php
/**
 * 框架基础类
 * 完成以下功能:
 * 1.读取配置 2.自动加载 3.请求分发
 */
class Base{
    public function run(){

        $this -> loadConfig();  //加载配置
        $this -> registerAutoLoad(); //注册自动加载
        $this -> getRequestParams(); //获取请求参数
        $this -> dispatch();  //请求分发
    }
    public function loadConfig(){  //读取配置
        $GLOBALS['config'] = require './app/config/config.php';
    }
    public function userAutoload($className){
        $baseClaee = [
            'Model' => './fwk/Model.php',
            'Controller' =>'./fwk/Controller.class.php',
            'Db' => './fwk/Db.php',
            'Page'=>'./fwk/pages.class.php',
            'upload' => './fwk/uploadfun.class.php'
        ];
        if(isset($baseClaee[$className])){
            require $baseClaee[$className];
        }elseif(substr($className,-5) == 'Model'){
            require './app/'.PLATFORM.'/Model/'.$className.'.class.php';
        }elseif(substr($className,-10)=='Controller'){
            require './app/'.PLATFORM.'/controller/'.$className.'.class.php';
        }
    }
    private function registerAutoLoad(){
        spl_autoload_register([$this,'userAutoload']);
    }
    private function getRequestParams(){
        $defPlate = $GLOBALS['config']['app']['default_platform'];
        $p = isset($_GET['p'])?$_GET['p']:$defPlate;
        define('PLATFORM',$p);

        @$defController = $GLOBALS['config'][PLATFORM]['default_controller'];
        $a = isset($_GET['c'])?$_GET['c']:$defController;
        define('CONTROLLER',$a);

        $defAction = $GLOBALS['config'][$defPlate]['default_action'];
        $a = isset($_GET['a'])?$_GET['a']:$defAction;
        define('ACTION',$a);
    }
    private function dispatch(){
        $conytolooerName = CONTROLLER.'Controller';
        $controller = new $conytolooerName;
        $actionName = ACTION.'Action';
        $controller->$actionName();
    }
}