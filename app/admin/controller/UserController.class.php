<?php
    //用户控制器
    class UserController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new UserModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function ListAction(){
            $set_sql = "SELECT * FROM user WHERE user_id = 1";
            $data = $this->dao->fetchRow($set_sql);
            require_once './app/admin/view/user_index.html';
        }

        public function UpdadeAction(){
            $user_user = $this->input($_POST['user_user']);
            $user_name = $this->input($_POST['user_name']);
            $user_pwd = $this->input($_POST['user_pwd']);
            $user_Birthday = $this->input($_POST['user_Birthday']);
            $user_phone = $this->input($_POST['user_phone']);
            $user_meg = $this->input($_POST['user_meg']);
            $user_mail = $this->input($_POST['user_mail']);
            $user_qq = $this->input($_POST['user_qq']);
            $insert_user = "UPDATE user SET user_user='$user_user',user_name='$user_name',user_pwd='$user_pwd',user_Birthday='$user_Birthday',user_phone='$user_phone',user_meg='$user_meg',user_mail='$user_mail',user_qq='$user_qq' WHERE user_id =1";
            if($this->dao->exec($insert_user)){
                echo "<script>alert('修改成功')</script>";
                echo "<script>location='?p=admin&c=User&a=List'</script>";
            }else{
                echo "<script>alert('失败')</script>";
                echo "<script>location='?p=admin&c=User&a=List'</script>";
            }
        }
    }

?>