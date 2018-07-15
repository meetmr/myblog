<?php
    //关于我
    class AboutController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ArticleModel();
        }

        public function ListAction(){
            //查询网站设置
            $sql_setup = "SELECT * FROM setup WHERE setup_id = 1";
            $setup_data = $this->dao->fetchRow($sql_setup);

            //查询用户信息
            $sql_user = "SELECT * FROM user WHERE user_admin = 1";
            $user_data = $this->dao->fetchRow($sql_user);
            require_once './app/home/view/about.html';
        }
    }
?>