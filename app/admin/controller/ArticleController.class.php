<?php
    /**
     * 文章控制器.
     * User: admin
     * Date: 2017/12/23
     * Time: 16:01
     */

    class ArticleController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ArticleModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function listAction(){   // 显示
            $sql = "select count(*) as sum from article ";
            $nun = $this->dao->fetchRow($sql);
            $row = $nun['sum'];  //得到总数量
            $page = new Page();
            $page->url = 'index.php?p=admin&c=Article&a=List';
            $page -> now_page = isset($_GET['page'])?$_GET['page']:1;
            //每页显示几条记录
            $page -> pagesize = 10;
            //总的记录数
            $page -> total_pages = $row;
            $offset = ($page -> now_page - 1)*$page->pagesize;
            $size = $page -> pagesize;
            $sql_art = "select article.art_id,article.col_id ,art_name,art_num,article.user_id,article.art_title,article.art_content ,article.aer_time, user.user_name,user.user_id,class.col_id,col_content from article,user,class WHERE article.col_id = class.col_id and article.user_id = user.user_id ORDER BY aer_time DESC  limit $offset, $size ";
            $data = $this->dao->fetchAll($sql_art);
            require_once './app/admin/view/art_index.html';
        }
        public function AddAction(){
            $sql_class = "SELECT * FROM class ";
            $date = $this->dao->fetchAll($sql_class);
            require_once './app/admin/view/art_add.html';
        }
        public function InsertAction(){   //添加文章
            $image = $_FILES['thumb'];
            $root = $_SERVER['DOCUMENT_ROOT'];
            $path = $root.'/public/upload';
            if(!($image['error'] ==4)){
                $allow = array('image/jpeg', 'image/png', 'image/gif');
                $maxsize = 5242880;//0.5M
                $result = new upload( $image,$allow,$error,$path,$maxsize);
                $url =  $result->imgname;
                $host = $_SERVER['HTTP_HOST'];
                $url = 'http://'.$host."/public/upload/".$url;
                $title = $this->input($_POST['title']);
                $author = $this->input($_POST['author']);
                $content = $_POST['content'];
                $cateid = $this->input($_POST['cateid']);
                $time = time();
                $art_insert = "INSERT INTO article (col_id,user_id,art_title,art_content,art_cover,art_num,art_name,aer_time) VALUES ($cateid,1,'$title','$content','$url',0,'$author','$time')";
                if($this->dao->exec($art_insert)){
                    echo "<script>location='?p=admin&c=Article&a=List'</script>";
                }else{
                    echo "<script>alert('未知错误，添加失败')</script>";
                    echo "<script>location='?p=admin&c=Article&a=Add'</script>";
                }
            }
        }

        public function DeleteAction(){   //删除文章
            $art_id = $this->input($_GET['art_id']);
            // 删除文章 必定要将缩略图一并删除、所以先通过id找到缩略图。
            $art_img = "SELECT art_cover FROM article  WHERE art_id = '$art_id'";
            $art_img = $this->dao->fetchRow($art_img);
            $art_img = substr($art_img['art_cover'],-30,30) ;
            //删除语句
            $delete_art = "DELETE FROM article WHERE  art_id = '$art_id'";
            if($this->dao->exec($delete_art)){
                // 将评论表中的数据也要删除
                $dis_delete = "DELETE FROM discuss WHERE art_id = '$art_id'";
                $this->dao->exec($dis_delete);
                if(unlink($art_img)){
                    echo "<script>alert('删除成功')</script>";
                    echo "<script>location='?p=admin&c=Article&a=List'</script>";
                }
            }else{
                echo "<script>alert('未知错误,删除失败')</script>";
                echo "<script>location='?p=admin&c=Article&a=List'</script>";
            }

        }

        public function UpdateAction(){   //修改文章视图
            $art_id = $this->input($_GET['art_id']);
            $sql_art = "SELECT * FROM article WHERE art_id = '$art_id'";
            $data = $this->dao->fetchRow($sql_art);
            $sql_class = "SELECT * FROM class ";
            $date = $this->dao->fetchAll($sql_class);
            require_once './app/admin/view/art_update.html';
        }

        public function modifyAction(){
            $art_id = $this->input($_POST['art_id']);
            $title = $this->input($_POST['title']);
            $author = $this->input($_POST['author']);
            $cateid = $this->input($_POST['cateid']);
            $content =$_POST['content'];
            $update = "UPDATE  article SET art_title = '$title',art_name ='$author',col_id='$cateid',art_content='$content'  WHERE art_id = '$art_id'";
            if($this->dao->exec($update)){
                echo "<script>alert('修改成功')</script>";
                echo "<script>location='?p=admin&c=Article&a=List'</script>";
            }else{
                echo "<script>alert('修改失败')</script>";
                echo "<script>location='?p=admin&c=Article&a=List'</script>";
            }
        }
    }
?>