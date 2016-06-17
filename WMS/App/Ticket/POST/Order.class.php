<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/7
 * Time: 09:29
 */
namespace App\Ticket\POST;
use App\Ticket\DELETE\Model;

/**
 * 工单
 * Class Order
 * @package App\Ticket\GET
 */
class Order extends \App\Ticket\Common
{
    public $config;
    public function __init() {
        $this->config = require PES_PATH . 'Config/config.php';
    }
    public function index()
    {
        $data['order_type']         = $this->isP('order_type', '系统参数错误，请重新打开提交工单页面再试');
        $data['applicants_id']      = $this->isP('applicants_id', '系统参数错误，请重新登录再试');
        $data['applicants_name']    = $this->isP('applicants_name', '系统参数错误，请重新登录再试');
        $data['applicants_dep_id']  = $this->isP('applicants_dep_id');
        $data['applicants_boss_id'] = $_POST['applicants_boss_id'];
        $data['requirement']        = $this->isP('requirement','请填写工单描述信息');
        if($data['order_type'] == 1){
            $data['order_sn'] = "ASAF".time();
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
            $data['order_sn'] = "AFPD".time();
            $data['urgency_type']   = empty($_POST['urgency_type']) ? 0 : $_POST['urgency_type'];
            $data['finish_time']    = $_POST['finish_time'];
        }elseif($data['order_type'] == 3){
            $data['order_sn'] = "FBAR".time();
            $data['bug_url']        = $_POST['bug_url'];
        }

        if(!empty($_FILES['attachment']['tmp_name'])){
            $suf = strtolower(end(explode('.',$_FILES['attachment']['name'])));
            $file_name = date("YmdHis").".".$suf;
            $path = PES_PATH."/".$this->config['UPLOAD_PATH']."/Order/".$file_name;
            $file_tmp_name = $_FILES['attachment']['tmp_name'];
            //转移上传文件
            $upload = move_uploaded_file($file_tmp_name,$path);
            $data['attachment']         = $file_name;
        }
        $data['add_time'] = date("Y-m-d H:i:s");
        if($upload){
            $res = \Model\OrderModel::saveWorkOrder($data);
        }
        if($res){
            $this->success('提交成功!', $this->url('Ticket-Order-index'));
        }else{
            $this->error('保存失败!请刷新后重试!');
        }
    }
}