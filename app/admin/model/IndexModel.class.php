<?php
    /**
     * 后台主页面模型
     * User: admin
     * Date: 2017/12/23
     * Time: 9:18
     */
    class IndexModel extends Model{
        /*
         * 查询网站设置
         * */
        public function setup(){
            $datasetup = "select * from setup ";
            return $this->data = $this->dao->fetchRow($datasetup);
        }
    }
?>