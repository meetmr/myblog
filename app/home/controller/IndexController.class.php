<?php
    /*
     * 主页控制器
     * */
    class IndexController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new IndexModel();
        }
        public function IndexAction(){

            //查询网站设置
            $sql_setup = "SELECT * FROM setup WHERE setup_id = 1";
            $setup_data = $this->dao->fetchRow($sql_setup);

            $sql = "select count(*) as sum from article ";
            $nun = $this->dao->fetchRow($sql);
            $row = $nun['sum'];  //得到总数量
            $page = new Page();
            $page->url = '?';
            $page -> now_page = isset($_GET['page'])?$_GET['page']:1;
            //每页显示几条记录
            $page -> pagesize = 10;
            //总的记录数
            $page -> total_pages = $row;
            $offset = ($page -> now_page - 1)*$page->pagesize;
            $size = $page -> pagesize;

            //查询文章
            $sql_art = "SELECT * FROM  article ORDER BY aer_time DESC limit $offset, $size ";
            $aer_data = $this->dao->fetchAll($sql_art);

            //查询最新发布的文章
            $sql_art_new = "SELECT  art_id,art_title FROM  article ORDER BY aer_time DESC limit 0,10";
            $art_new = $this->dao->fetchAll($sql_art_new);

            //查询分类
            $sql_class = "SELECT * FROM class ";
            $class_data = $this->dao->fetchAll($sql_class);

            //查询友情连接
            $sql_ct = "SELECT * FROM `connect` ";
            $ct_data = $this->dao->fetchAll($sql_ct);

            //更新访问量
            if(!isset($_SESSION['num'])){
                $update_num = "UPDATE setup SET  amount = amount+1 WHERE setup_id = 1";
                $this->dao->exec($update_num);
                $_SESSION['num'] = 1;
            }

            require_once './app/home/view/index.html';
        }
    }
?>