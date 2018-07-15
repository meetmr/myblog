<?php

    class DiscussController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new DiscussModel();
        }

        public function InsertAction(){  //发表评论
            $art_id = $this->input($_GET['art_id']);
            $name = $this->input($_POST['name']);
            $content = $this->input($_POST['content']);
            $time = time();
            $insert_dis = "INSERT INTO discuss VALUES (NULL,$art_id,'$name','$content','XXX',$time)";
            if($this->dao->exec($insert_dis)){
                echo "<script>alert('评论成功')</script>";
                echo "<script>location='?c=Article&a=Details&art_id=$art_id'</script>";
            }
        }
    }
?>