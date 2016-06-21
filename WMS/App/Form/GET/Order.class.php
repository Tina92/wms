<?php
/**
 * .
 * User: YaoJie
 * Date: 2016/6/21
 * Time: 11:58
 */

namespace App\Form\GET;


class Order extends \App\Form\Common{
    public function info(){
        $this->user = $_SESSION['ticket'];
        $this->user['group_name'] = $this->db('user_group')->field('user_group_name')->where("user_group_id=:user_group_id")->find(array('user_group_id'=>$this->user['user_group_id']))['user_group_name'];
        $this->assign('user',$this->user);
        $number = $this->isG('order_sn', '请选择您要查看的工单');
        if(strlen($number) < 14){
            self::error("请输入有效的工单号");
        }
        $info = \Model\OrderModel::findOrderBySn($number);
        if (empty($info)) {
            self::error('工单不存在');
        }
        $this->assign('info',$info);
        $this->layout();
    }
}