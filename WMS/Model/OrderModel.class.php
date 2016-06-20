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

    /**
     * 获取对应用户的对应状态的工单列表
     * @param $user_id              用户ID
     * @param int $user_group_id    用户组ID    A/B/C/D    技术部领导/技术部成员/用户部领导/用户部成员
     * @param int $user_boss        上级领导ID
     * @param int $type             工单状态    0->未审核；1->已审核；2->已完成
     * @param int $page             当前页数
     * @param int $page_num         每页数量
     * @return bool
     */
    public function getUserOrderList($user_id, $user_group_id=0, $user_boss=0, $type = 0, $page=1, $page_num=10){
        $page_start = ($page-1)*$page_num;
        $where = "1 ";
        if($user_group_id == 1){
            if(isset($type)){
                switch($type){
                    case 0 :
                        $where .= "AND verify_type = 1 ";
                        break;
                    case 1 :
                        $where .= "AND verify_type = 3 ";
                        break;
                    case 2:
                        $where .= "AND verify_type in('2','4','5') ";
                        break;
                }
            }
        }elseif($user_group_id == 2){

        }elseif($user_group_id > 0){
            if($user_boss>0){
                if(isset($type)){
                    switch($type){
                        case 0 :
                            $where .= "AND verify_type in('0','1') ";
                            break;
                        case 1 :
                            $where .= "AND verify_type = 3 ";
                            break;
                        case 2:
                            $where .= "AND verify_type in('2','4','5') ";
                            break;
                    }
                }
                if(isset($user_id) && !empty($user_id)){
                    $where .= "AND applicants_id = ".$user_id." ";
                }
            }else{
                if(isset($type)){
                    switch($type){
                        case 0 :
                            $where .= "AND verify_type = 0 ";
                            break;
                        case 1 :
                            $where .= "AND verify_type in('1','3') ";
                            break;
                        case 2:
                            $where .= "AND verify_type in('2','4','5') ";
                            break;
                    }
                }
                $where .= "AND applicants_dep_id = ".$user_group_id." ";
            }
        }
        $result = self::getOrderByWCPP($where,$page_start,$page_num);
        return $result;
    }

    /**
     * 按照条件查询信息
     * @param $where
     * @param $page_start
     * @param $page_num
     * @return bool
     */
    public function getOrderByWCPP($where,$page_start,$page_num){
        $res = self::db('work_order')
            ->where($where)
            ->order('id DESC')
            ->limit("{$page_start},{$page_num}")
            ->select();
        if($res){
            return $res;
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