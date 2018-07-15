<?php
    /**
     * 后台主页控制器.
     * User: admin
     * Date: 2017/12/23
     * Time: 16:01
     */
    session_start();
     class IndexController extends Controller{
         protected $dao = null;
         public function __construct(){
             $this->dao = new IndexModel();
             $this->login('index.php?p=admin&c=Land&a=Land');
         }
         public function IndexAction(){
             $index = new IndexModel();
             $setup = $index->setup();   //查询网站设置
             $user = $_SESSION['user_user'];
             $pic = $_SESSION['user_pic'];
             //查询用户数量
             $user_num = "SELECT COUNT(*) as num FROM user ";
             $user_num = $this->dao->fetchRow($user_num);
             $user_num = $user_num['num'];
             //查询文章数量
             $art_num = "SELECT COUNT(*) as num FROM article";
             $art_num = $this->dao->fetchRow($art_num);
             $art_num = $art_num['num'];
             //查询评论数量
             $dis_num = "SELECT COUNT(*) as num FROM discuss";
             $dis_num = $this->dao->fetchRow($dis_num);
             $dis_num = $dis_num['num'];
             require_once './init.php';
             require './app/admin/view/index.html';
         }


     }
?>
