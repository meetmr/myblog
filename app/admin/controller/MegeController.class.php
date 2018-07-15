<?php
    /*
     * 留言表的控制器
     *
     * **/
    class MegeController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new MegeModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function ListAction(){

            $sql = "select count(*) as sum from messgae ";
            $nun = $this->dao->fetchRow($sql);
            $row = $nun['sum'];  //得到总数量
            $page = new Page();
            $page->url = 'index.php?p=admin&c=Mege&a=List';
            $page -> now_page = isset($_GET['page'])?$_GET['page']:1;
            //每页显示几条记录
            $page -> pagesize = 10;
            //总的记录数
            $page -> total_pages = $row;
            $offset = ($page -> now_page - 1)*$page->pagesize;
            $size = $page -> pagesize;


            $sql_meg = "SELECT * FROM  messgae ORDER BY me_tiem DESC  limit $offset, $size " ;
            $data = $this->dao->fetchAll($sql_meg);
            require './app/admin/view/meg_index.html';
        }

        public function DeleteAction(){
            $me_id = $this->input($_GET['me_id']);
            $delete_me = "DELETE FROM messgae WHERE me_id = '$me_id'";
            if($this->dao->exec($delete_me)){
                echo "<script>location='?p=admin&c=Mege&a=List'</script>";
            }else{
                echo "<script>alert('删除失败')</script>";
                echo "<script>location='?p=admin&c=Mege&a=List'</script>";
            }
        }
    }
?>