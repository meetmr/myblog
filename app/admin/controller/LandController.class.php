<?php
    /*
     * 登陆模块控制器
     *
     * */
@session_start();
class LandController extends Controller{
        public function LandAction(){
            require_once './init.php';
            require './app/admin/view/login.html';
        }
        public function LogAction(){  //处理登陆
            $user = $this->input($_POST['user']);
            $pwd = $this->input($_POST['pwd']);
            $code = $this->input($_POST['passcode']);
            $VerifyCode  = $_SESSION["VerifyCode"];
            if($code != $VerifyCode){
                echo "<script>alert('验证码错误')</script>";
                echo "<script>location='?p=admin&c=Land&a=Land'</script>";
            }else{
               $user_sql = "SELECT user_id,user_user,user_name,user_admin,user_pic FROM user WHERE user_user = '$user' AND user_pwd = '$pwd'";
               $dao = new LandModel();
               if($data = $dao->fetchRow($user_sql)){
                   $_SESSION['user_id'] = $data['user_id'];//拿到用户ID
                   $_SESSION['user_user'] = $data['user_user'];
                   $_SESSION['user_name'] = $data['user_name'];
                   $_SESSION['user_admin'] = $data['user_admin'];
                   $_SESSION['user_pic'] = $data['user_pic'];
                   require_once './app/admin/view/jump.html';
               }else{
                   echo "<script>alert('登陆失败！')</script>";
                   echo "<script>location='?p=admin&c=Land&a=Land'</script>";
               }
            }
        }
        public function OutAction(){   //处理退出登陆
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset( $_SESSION['user_name']);
            unset($_SESSION['user_admin']);
            unset( $_SESSION['user_pic']);
            echo "<script>location='?p=admin&c=Land&a=Land'</script>";
        }
    }


?>