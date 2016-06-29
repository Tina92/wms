<?php
/**
 * .
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
            self::error('该工单不存在，请输入有效的工单号');
        }else{
            $result['applicants_dep_name'] = self::db('user_group')->where("user_group_id = {$result['applicants_dep_id']}")->find()['user_group_name'];
            $result['boss_name'] = self::db('user')->where("user_id = {$result['applicants_boss_id']}")->find()['user_name'];
        }
        return $result;
    }

    /**
     * 根据条件查询工单信息
     * @param $where
     * @param array $condition
     * @return mixed
     */
    public function findOrderByWC($where, $condition = array()){
        $result = self::db('work_order')->where($where)->find($condition);
        if(empty($result)){
            self::error("该工单不存在,或者您的权限无法浏览该工单信息");
        }else{
            $result['applicants_dep_name'] = self::db('user_group')->where("user_group_id = {$result['applicants_dep_id']}")->find()['user_group_name'];
            $result['boss_name'] = self::db('user')->where("user_id = {$result['applicants_boss_id']}")->find()['user_name'];
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
        $where = "delete_state = 0 ";
        if($user_group_id == 1){
            if(isset($type)){
                switch($type){
                    case 0 :
                        $where .= "AND verify_type = 1 AND order_state <> 1 ";
                        break;
                    case 1 :
                        $where .= "AND verify_type = 3 AND order_state <> 1  ";
                        break;
                    case 2:
                        $where .= "AND (verify_type in('2','4','5') OR order_state = 1) ";
                        break;
                }
            }
        }elseif($user_group_id == 2){

        }elseif($user_group_id > 2){
            if($type == 3){
                $where .= "AND cc LIKE '%,{$user_id},%' ";
            }else{
                if($user_boss>0){
                    if(isset($type)){
                        switch($type){
                            case 0 :
                                $where .= "AND verify_type in('0','1') AND order_state <> 1 ";
                                break;
                            case 1 :
                                $where .= "AND verify_type = 3 AND order_state <> 1  ";
                                break;
                            case 2:
                                $where .= "AND (verify_type in('2','4','5') OR order_state = 1) ";
                                break;
                        }
                    }
                    $where .= "AND applicants_id = ".$user_id." ";
                }else{
                    if(isset($type)){
                        switch($type){
                            case 0 :
                                $where .= "AND verify_type = 0 AND order_state <> 1 ";
                                break;
                            case 1 :
                                $where .= "AND verify_type in('1','3') AND order_state <> 1  ";
                                break;
                            case 2:
                                $where .= "AND (verify_type in('2','4','5') OR order_state = 1) ";
                                break;
                        }
                    }
                    $where .= " AND applicants_dep_id = ".$user_group_id." ";
                }
            }
        }
        $result = self::getOrderByWPP($where,$page_start,$page_num);
        return $result;
    }

    /**
     * 按照条件查询信息
     * @param $where
     * @param $page_start
     * @param $page_num
     * @return bool
     */
    public function getOrderByWPP($where,$page_start,$page_num){
        $res['data'] = self::db('work_order')
            ->where($where)
            ->order('id DESC')
            ->limit("{$page_start},{$page_num}")
            ->select();
        $count = count(self::db('work_order')->where($where)->select());
        $res['count'] = ceil($count/10);//取得当前总页数
        if($res){
            return $res;
        }else{
            return array('count'=>0,'data'=>false);
        }
    }

    /**
     * 提交保存工单信息
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

    public function finished($order_id){
        if(!empty($order_id)){
            $data['order_state'] = 1;
            $data['finished_time'] = date("Y-m-d H:i:s");
            $res = self::db('work_order')->where("id={$order_id}")->update($data);
            if($res){
                $result = 1;
            }else{
                $result = 0;
            }
        }else{
            $result = -1;
        }
        return $result;
    }

    public function delete($order_id){
        if(!empty($order_id)){
            $data['delete_state'] = 1;
            $res = self::db('work_order')->where("id={$order_id}")->update($data);
            if($res){
                $result = 1;
            }else{
                $result = 0;
            }
        }else{
            $result = -1;
        }
        return $result;
    }

    /**
     * 领导审核
     * @param $boss_id
     * @param $order_id
     * @param int $verify
     * @return int
     */
    public function bossVerify($boss_id,$order_id,$verify=0){
        if(!empty($order_id)){
            $boss_id = empty($boss_id) ? $_SESSION['ticket']['user_id'] : $boss_id;
            $data['verify_type'] = ($verify == 1) ? 1 : 2;
            $data['boss_verifier'] = $boss_id;
            $data['boss_verify_time'] = date("Y-m-d H:i:s");
            $res = self::db('work_order')->where("id={$order_id}")->update($data);
            if($res){
                $result = 1;
            }else{
                $result = 0;
            }
        }else{
            $result = -1;
        }
        return $result;
    }

    /**
     * 技术部领导审核信息
     * @param $technology_id
     * @param $order_id
     * @param int $verify
     * @param string $mark
     * @return int
     */
    public function technologyVerify($technology_id,$order_id,$verify=0,$mark=""){
        if(!empty($order_id)){
            $technology_id = empty($technology_id) ? $_SESSION['ticket']['user_id'] : $technology_id;
            $data['verify_type'] = ($verify == 1) ? 3 : 4;
            $data['verifier_id'] = $technology_id;
            $data['verify_time'] = date("Y-m-d H:i:s");
            $data['verify_mark'] = $mark;
            $res = self::db('work_order')->where("id={$order_id}")->update($data);
            if($res){
                $result = 1;
            }else{
                $result = 0;
            }
        }else{
            $result = -1;
        }
        return $result;
    }

}