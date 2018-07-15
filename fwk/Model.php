<?php
    /*
     * 公共的模型类
     * 提供公共的方法
     * 1、链接数据库
     * 2、查询数据
     * 3、删除数据
     * 4、更新数据
     * 5、插入数据
     *
     * */
    class Model{
        protected $dao = null;         //数据库连接资源
        public $data = null;           //获取到的资源数据
        //构造函数用于初始化数据库连接
        public function __construct(){
            $this->init();
        }
        private function init(){
            $this->dao = Db::getSingLenton();
        }
        /*
         * 查询全部数据的方法
         * $sql : 传入的sql语句
         * return :返回获取到的数据
         * */
        public function fetchAll($sql){
            return $this->data = $this->dao->fetchAll($sql);
        }
        /*
         * 查询单条数据的方法
         * $sql : 传入的sql语句
         * return :返回获取到的数据
         */
        public function fetchRow($sql){
            return $this->data = $this->dao->fetchRow($sql);
        }
        /*
         * 执行dml语句
         * $sql : 传入的sql语句
         * return :返回受影响的记录
         * */
        public function exec($sql){
            return $this->data = $this->dao->exec($sql);
        }
    }
?>