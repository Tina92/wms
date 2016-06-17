<?php
/**
 * Created by PhpStorm.
 * User: YaoJie
 * Date: 2016/6/16
 * Time: 14:04
 */
namespace Model;

class OrderModel extends \Core\Model\Model {

    /**
     * 根据工单号查询工单
     */
    public function findOrderBySn($sn){
        $result = self::db('work_order')->where('order_sn = :order_sn')->find(array('order_sn' => $sn));
        if(empty($result)){
            self::error('该工单不存在');
        }
        return $result;
    }

    public function getUserOrderList($user_id, $user_group_id=0, $page1=1, $page2=1, $page_num=10){
        $page_1 = ($page1-1)*$page_num;
        $page_2 = ($page2-1)*$page_num;
        switch($user_group_id){
            case 0 :

                break;
            case 1 :
                $arra = $this->getAllOrder();

                break;
            case 2 :

                break;
            default :
                $arra = $this->getMyOrderList($user_id,$page_1,$page_num);
                break;
        }



    }

    public function getAllOrder(){

    }

    public function getMyOrderList($user_id = 0,$start,$page_num=10){
        if($user_id > 0){
            $result = self::db('work_order')
                ->where("applicants_id = :user_id")
                ->order('id DESC')
                ->limit($start,$page_num)
                ->select(array('user_id' => $user_id));
        }
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function saveWorkOrder($data){
        $result = self::db('work_order')->insert($data);
        if(empty($result)){
            self::error('工单保存失败');
        }
        return $result;
    }

}