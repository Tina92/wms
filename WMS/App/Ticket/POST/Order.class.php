<?php
/**
 * .
 * User: YaoJie
 * Date: 2016/6/7
 * Time: 09:29
 */
namespace App\Ticket\POST;

/**
 * 工单
 * Class Order
 * @package App\Order\POST
 */
class Order extends \App\Ticket\Common
{
    public $config;
    public $user;
    public function __init() {
        $this->config = require PES_PATH . 'Config/config.php';
        $this->user = $_SESSION['ticket'];
        $this->user['group_name'] = $this->db('user_group')->field('user_group_name')->where("user_group_id=:user_group_id")->find(array('user_group_id'=>$this->user['user_group_id']))['user_group_name'];
    }

    public function index()
    {
        $data['order_type']         = $this->isP('order_type', '系统参数错误，请重新打开提交工单页面再试');
        $data['applicants_id']      = $this->isP('applicants_id', '系统参数错误，请重新登录再试');
        $data['applicants_name']    = $this->isP('applicants_name', '系统参数错误，请重新登录再试');
        $data['applicants_dep_id']  = $this->isP('applicants_dep_id');
        $data['applicants_boss_id'] = $_POST['applicants_boss_id'];
        if($data['applicants_boss_id'] == 0){
            $data['verify_type'] = 1;
            $data['boss_verifier'] = $data['applicants_id'];
            $data['boss_verify_time'] = date("Y-m-d H:i:s");
        }
        $data['requirement']        = $this->isP('requirement','请填写工单描述信息');
        if($data['order_type'] == 1){
            $data['order_sn'] = "S";
            $data['urgency_type']   = empty($_POST['urgency_type']) ? 0 : $_POST['urgency_type'];
            $data['finish_time']    = $_POST['finish_time'];
            $design_type            = $this->isP('design_type',"请选择设计类型");
            $arr = array();
            if(count($design_type) > 0){
                foreach($design_type as $k => $v){
                    if($v == "on")$arr[] = $k;
                }
            }
            $data['design_type']    = (count($arr) > 0) ? ",".implode(',',$arr)."," : "";
            unset($design_type);
            unset($arr);
            $data['adv_start_time'] = $_POST['adv_start_time'];
            $data['adv_end_time']   = $_POST['adv_end_time'];
        }elseif($data['order_type'] == 2){
            $data['order_sn'] = "D";
            $data['urgency_type']   = empty($_POST['urgency_type']) ? 0 : $_POST['urgency_type'];
            $data['finish_time']    = $_POST['finish_time'];
        }elseif($data['order_type'] == 3){
            $data['order_sn'] = "A";
            $data['bug_url']        = $_POST['bug_url'];
        }
        $year = date("y");
        $month = date("m");
        $day = date("d");
        $osn_mid = strtoupper(dechex($year-15).dechex($month).str_pad(dechex($day),2,'0',STR_PAD_LEFT));
        $data['order_sn'] .= $osn_mid;
        $resa = self::db('work_order')->where("order_sn LIKE '{$data['order_sn']}%'")->order("order_sn DESC")->limit('1')->find();
        if($resa){
            $data['order_sn'] .= str_pad((intval(substr($resa['order_sn'],-2))+1),2,'0',STR_PAD_LEFT);
        }else{
            $data['order_sn'] .= "01";
        }
        if(!empty($_FILES['attachment']['tmp_name'])){
            if($_FILES['attachment']['size'] > 10485760){
                $this->error("附件过大，不允许上传超过10M的附件!");
            }
            $allow_file = explode("|", "gif|jpg|png|jpeg|doc|docx|dot|dotx|xls|xlt|xla|xlsx|xltx|xlsm|xltm|xlam|xlsb|rar|zip"); //允许上传的文件类型组
            $suf = strtolower(end(explode('.',$_FILES['attachment']['name'])));
            if (!in_array(strtolower($suf),$allow_file)){
                $this->error("[".strtoupper($suf)."]类型文件不允许上传!");
            }
            $file_name = date("YmdHis").".".$suf;
            $path = PES_PATH.$this->config['UPLOAD_PATH']."Order/".$file_name;
            $file_tmp_name = $_FILES['attachment']['tmp_name'];
            //转移上传文件
            $upload = move_uploaded_file($file_tmp_name,$path);
            $data['attachment']         = $file_name;
        }
        $data['add_time'] = date("Y-m-d H:i:s");
        $res = \Model\OrderModel::saveWorkOrder($data);

        if($res){
            $this->success('提交成功!', $this->url('Ticket-Order-index'));
        }else{
            $this->error('保存失败!请刷新后重试!');
        }
    }

    public function getOrderListByPage(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
            $ui = isset($this->user['user_id']) ? (empty($this->user['user_id']) ? 0 : intval($this->user['user_id'])) : 0;
            $ut = isset($this->user['user_group_id']) ? (empty($this->user['user_group_id']) ? 0 : intval($this->user['user_group_id'])) : 0;
            $ub = isset($this->user['user_boss']) ? (empty($this->user['user_boss']) ? 0 : intval($this->user['user_boss'])) : 0;
            $pa = isset($_POST['page']) ? intval($_POST['page']) : 1;
            $tp = isset($_POST['type']) ? $_POST['type'] : 0;
            $order_list = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, $tp, $pa, 10);
            if($order_list){
                $data['state'] = true;
                $data['data'] = $order_list;
                echo(json_encode($data));
            }else{
                echo(json_encode(array('state'=>false)));
            }
        }
    }

    public function finished()
    {
        if($this->user['user_group_id']==1){
            $order_id = $this->isP('oid',"参数获取失败，请刷新后重试");
            $res = \Model\OrderModel::finished($order_id);
            echo $res;
        }else{
            $this->error("您没有权限执行此项操作");
        }
    }

    public function delete()
    {
        if($this->user['user_group_id']==1){
            $order_id = $this->isP('oid',"参数获取失败，请刷新后重试");
            $res = \Model\OrderModel::delete($order_id);
            echo $res;
        }else{
            $this->error("您没有权限执行此项操作");
        }
    }

    public function bossVerify()
    {
        $user_id = isset($this->user['user_id']) ? (empty($this->user['user_id']) ? 0 : intval($this->user['user_id'])) : 0;
        $order_id = $_POST['oid'];
        $verify_type = $_POST['verify'];
        $res = \Model\OrderModel::bossVerify($user_id,$order_id,$verify_type);
        echo $res;
    }

    public function technologyVerify(){
        $user_id = isset($this->user['user_id']) ? (empty($this->user['user_id']) ? 0 : intval($this->user['user_id'])) : 0;
        $order_id = $_POST['oid'];
        $verify_type = $_POST['verify'];
        $verify_mark = $_POST['verify_mark'];
        $res = \Model\OrderModel::technologyVerify($user_id,$order_id,$verify_type,$verify_mark);
        echo $res;
    }

}