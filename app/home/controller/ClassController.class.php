<?php
    /*
    * 分类
    * */

    class ClassController extends Controller{
            protected $dao = null;
            public function __construct(){
                $this->dao = new ClassModel();
            }

            public function ListAction(){
                $col_id = $this->input($_GET['col_id']);

                //查询网站设置
                $sql_setup = "SELECT * FROM setup WHERE setup_id = 1";
                $setup_data = $this->dao->fetchRow($sql_setup);

                //查询栏目名称
                $name_sql = "SELECT col_content FROM class WHERE col_id = '$col_id'";
                $col_name = $this->dao->fetchRow($name_sql);

                //查询最新发布的文章
                $sql_art_new = "SELECT  art_id,art_title FROM  article ORDER BY aer_time DESC limit 0,10";
                $art_new = $this->dao->fetchAll($sql_art_new);

                //查询分类
                $sql_class = "SELECT * FROM class ";
                $class_data = $this->dao->fetchAll($sql_class);

                //查询友情连接
                $sql_ct = "SELECT * FROM `connect` ";
                $ct_data = $this->dao->fetchAll($sql_ct);

                $sql_art = "SELECT * FROM  article WHERE col_id = '$col_id' ORDER BY aer_time DESC  ";
                $aer_data = $this->dao->fetchAll($sql_art);
                require_once './app/home/view/class.html';
            }
    }
?>