<?php
    //入口分发器
    date_default_timezone_set('PRC');//设置相应头编码
    require './fwk/Base.php';  //导入框架基础类
    $app = new Base();   //实例化框架
    $app->run();  //运行框架
?>