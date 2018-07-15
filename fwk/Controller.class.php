<?php
    /*
     * 控制器基类
     * */
@session_start();
    class Controller{
        public function input($data){   //数据过滤
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        public function login($url){  //验证是否登陆
            if(!isset($_SESSION['user_id'])){
                echo "<script>location='$url'</script>";
                exit();
            }
        }
    }
?>