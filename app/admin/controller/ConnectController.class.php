<?php
    /**
     * 友情链接.
     * User: admin
     * Date: 2017/12/23
     * Time: 16:01
     */
    class ConnectController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new ConnectModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }

        public function ListAction(){
            $sql_co = "SELECT * FROM connect";
            $data = $this->dao->fetchAll($sql_co);
            require_once './app/admin/view/co_index.html';
        }

        public function InsertAction(){   //添加
            $ct_content = $this->input($_POST['ct_content']);
            $ct_url = $this->input($_POST['ct_url']);
            $ct_msg = $this->input($_POST['ct_msg']);
            $insert_ct = "INSERT INTO connect VALUES (NULL,'$ct_content','$ct_url','$ct_msg')";
            if($this->dao->exec($insert_ct)){
                echo "<script>alert('添加成功')</script>";
                echo "<script>location='?p=admin&c=Connect&a=List'</script>";
            }else{
                echo "<script>alert('未知错误,添加失败')</script>";
                echo "<script>location='?p=admin&c=Connect&a=List'</script>";
            }
        }

        public function DelAction(){    //删除
            $ct_id = $this->input($_GET['ct_id']);
            $ct_del = "DELETE FROM `connect` WHERE ct_id ='$ct_id'";
            if($this->dao->exec($ct_del)){
                echo "<script>alert('删除成功')</script>";
                echo "<script>location='?p=admin&c=Connect&a=List'</script>";
            }else{
                echo "<script>alert('未知错误,删除失败')</script>";
                echo "<script>location='?p=admin&c=Connect&a=List'</script>";
            }
        }
    }

?>