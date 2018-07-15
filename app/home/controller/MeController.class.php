<?php
    //留言
    class MeController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ArticleModel();
        }
        public function ListAction(){
            //查询网站设置
            $sql_setup = "SELECT * FROM setup WHERE setup_id = 1";
            $setup_data = $this->dao->fetchRow($sql_setup);
            $sql_me = " SELECT * FROM messgae ORDER BY me_tiem DESC ";
            $me_data = $this->dao->fetchAll($sql_me);
            require_once './app/home/view/message.html';
        }

        public function AddAction(){
            $name = $this->input($_POST['name']);
            $content = $this->input($_POST['content']);
            $time = time();

            $me_insertr = "INSERT INTO messgae VALUES (NULL,'$name','$content','xxdx.jpg',$time)";
            if($this->dao->exec($me_insertr)){
                echo "<script>alert('留言成功')</script>";
                echo "<script>location='?c=Me&a=List'</script>";
            }
        }
    }
?>