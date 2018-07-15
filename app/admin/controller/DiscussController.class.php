<?php
    /*
     * 评论表的控制器
     * 主要对评论表控制
     * 继承基础控制类
     * */

    class DiscussController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new DiscussModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function listAction(){
            $art_id = $this->input($_GET['art_id']);
            //获取文章详情
            $sql_art = "select article.art_id,article.col_id ,art_name,art_num,article.user_id,article.art_title,art_name,article.art_content ,article.aer_time, user.user_name,user.user_id,class.col_id,col_content from article,user,class WHERE article.col_id = class.col_id and article.user_id = user.user_id  and article.art_id='$art_id' ";
            $data = $this->dao->fetchRow($sql_art);
            //获取文章相关的评论
            $sql_dis = "SELECT * FROM discuss WHERE art_id = '$art_id'";
            $dis_data = $this->dao->fetchAll($sql_dis);
            require_once './app/admin/view/comment.html';
        }
        //删除单条评论
        public function DeleteAction(){
            $dis_id = $this->input($_GET['dis_id']);
            $art_id = $this->input($_GET['art_id']);
            $dis_delete = "DELETE FROM discuss WHERE dis_id = '$dis_id'";
            if($this->dao->exec($dis_delete)){
                echo "<script>alert('删除成功')</script>";
                echo "<script>location='?p=admin&c=Discuss&a=list&art_id=$art_id'</script>";
            }else{
                echo "<script>alert('未知错误、删除失败')</script>";
                echo "<script>location='?p=admin&c=Discuss&a=list&art_id=$art_id'</script>";
            }
        }


    }
?>