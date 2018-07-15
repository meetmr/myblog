<?php
    /**
     * 分类控制器.
     * User: admin
     * Date: 2017/12/23
     * Time: 16:01
     */

    class ClassController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ClassModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function listAction(){

            //****************分页*******************//
            $sql = "select count(*) as sum from class ";
            $nun = $this->dao->fetchRow($sql);
            $row = $nun['sum'];  //得到总数量
            $page = new Page();
            $page->url = 'index.php?p=admin&c=Class&a=List';
            $page -> now_page = isset($_GET['page'])?$_GET['page']:1;
            //每页显示几条记录
            $page -> pagesize = 10;
            //总的记录数
            $page -> total_pages = $row;
            $offset = ($page -> now_page - 1)*$page->pagesize;
            $size = $page -> pagesize;
            $class_sql = "SELECT * FROM class limit $offset, $size";
            $data = $this->dao->fetchAll($class_sql);
            require_once './app/admin/view/cate_index.html';
        }

        public function AddAction(){  //添加分类视图
            require_once './app/admin/view/cate_add.html';
        }

        public function AddCateAction(){  //处理分类入库
            $class_name = $this->input($_POST['classname']);
            $class_msg = $this->input($_POST['classmes']);
            $class_insert = "INSERT INTO class VALUES (NULL,'$class_name','$class_msg')";
            $data= $this->dao->exec($class_insert);
            if($data){
                echo "<script>location='?p=admin&c=Class&a=List'</script>";
            }else{
                echo "<script>alert('未知错误,添加失败')</script>";
                echo "<script>location='?p=admin&c=Class&a=Add'</script>";
            }
        }

        public function dlCateAction(){   //执行删除操作
            $cate_id = $this->input($_GET['cate_id']);
            $delete_class = "DELETE FROM  class WHERE col_id = '$cate_id'";
            $data = $this->dao->exec($delete_class);
            if($data){
                echo "<script>alert('删除成功')</script>";
                echo "<script>location='?p=admin&c=Class&a=List'</script>";
            }else{
                echo "<script>alert('未知错误，删除失败')</script>";
                echo "<script>location='?p=admin&c=Class&a=List'</script>";
            }
        }

        public function updateCateAction(){  //显示修改分类视图
            $cate_id = $this->input($_GET['cate_id']);
            $cate_sql = "SELECT * FROM class WHERE col_id ='$cate_id'";
            $data = $this->dao->fetchRow($cate_sql);
            require_once './app/admin/view/cate_updata.html';
        }
        public function upCateAction(){ //更新分类
            $class_name = $this->input($_POST['classname']);
            $class_msg = $this->input($_POST['classmes']);
            $classid = $this->input($_POST['classid']);
            $update_class = "UPDATE class SET col_content = '$class_name', col_message='$class_msg' WHERE col_id = '$classid'";
            $data = $this->dao->exec($update_class);
            if($data){
                echo "<script>location='?p=admin&c=Class&a=List'</script>";
            }else{
                echo "<script>alert('未知错误，删除失败')</script>";
                echo "<script>location='?p=admin&c=Class&a=updateCate&cate_id=$classid'</script>";
            }
        }
    }

?>