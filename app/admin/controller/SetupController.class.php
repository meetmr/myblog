<?php
    /**
     * 站点管理.
     * User: admin
     * Date: 2018/1/2
     * Time: 16:011
     */

    class SetupController extends Controller{
        protected $dao = null;
        public function __construct(){
            $this->dao = new SetupModel();
            $this->login('index.php?p=admin&c=Land&a=Land');
        }
        public function ListAction(){
            $set_sql = "SELECT * FROM setup WHERE setup_id = 1";
            $data = $this->dao->fetchRow($set_sql);
            require_once './app/admin/view/set_index.html';
        }

        //修改网站设置
        public function UpdaAction(){
            $website_name = $this->input($_POST['website_name']);
            $icp_code = $this->input($_POST['icp_code']);
            $mailbox = $this->input($_POST['mailbox']);
            $address = $this->input($_POST['address']);
            $notice = $this->input($_POST['notice']);
            $set_update = "UPDATE setup SET website_name='$website_name',icp_code = '$icp_code',mailbox='mailbox',address='$address',notice='$notice' WHERE setup_id = 1";
            if($this->dao->exec($set_update)){
                echo "<script>alert('修改成功')</script>";
                echo "<script>location='?p=admin&c=Setup&a=List'</script>";
            }else{
                echo "<script>alert('失败')</script>";
                echo "<script>location='?p=admin&c=Setup&a=List'</script>";
            }
        }
    }
?>