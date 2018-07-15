<?php
    /*
     * 文章详情控制器
* */
    class ArticleController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ArticleModel();
        }

        public function DetailsAction(){

            //查询网站设置
            $sql_setup = "SELECT * FROM setup WHERE setup_id = 1";
            $setup_data = $this->dao->fetchRow($sql_setup);
            $art_id = $this->input($_GET['art_id']);

            //查询id对应的文章
            $art_sql = "SELECT * FROM article WHERE art_id ='$art_id'";
            $art_row = $this->dao->fetchRow($art_sql);

            //文章访问次数
            $art_num_sql = "UPDATE article SET art_num = art_num+1 WHERE art_id = '$art_id'";
            $this->dao->exec($art_num_sql);

            //****************查询本栏目的文章**************************
            $col_id = $art_row['col_id'];
            $art_tuijian = "select art_id,art_title from article where col_id = $col_id ORDER BY aer_time DESC LIMIT 0,6";
            $tuijian_rew = $this->dao->fetchAll($art_tuijian);

            //查询分类名称
            $col_id = $art_row['col_id'];
            $col_sql = "SELECT col_content FROM class WHERE col_id = '$col_id'";
            $col_row = $this->dao->fetchRow($col_sql);

            //查询文章对应的评论
            $dis_sql = "SELECT * FROM discuss WHERE art_id = '$art_id' ORDER BY dis_tiem DESC ";
            $dis_data = $this->dao->fetchAll($dis_sql);
            require_once './app/home/view/template.html';
        }
    }
?>