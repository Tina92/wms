<?php
/**
 * Created by PhpStorm.
 * User: YaoJie
 * Date: 2016/6/2
 * Time: 15:58
 */
namespace App\Ticket\GET;

/**
 * 工单
 * Class Order
 * @package App\Ticket\GET
 */
class Order extends \App\Ticket\Common
{
    public final function __init() {
        $user = $_SESSION['ticket'];
        $user['group_name'] = $this->db('user_group')->field('user_group_name')->where("user_group_id=:user_group_id")->find(array('user_group_id'=>$user['user_group_id']))['user_group_name'];
        $this->assign('user',$user);
    }

    public function index(){
        $uid = isset($_SESSION['ticket']['user_id']) ? (empty($_SESSION['ticket']['user_id']) ? 0 : intval($_SESSION['ticket']['user_id'])) : 0;
        $ut = isset($_SESSION['ticket']['user_group_id']) ? (empty($_SESSION['ticket']['user_group_id']) ? 0 : intval($_SESSION['ticket']['user_group_id'])) : 0;
        $order_list = \Model\OrderModel::getUserOrderList($uid,$ut);
        $this->layout();
    }

    /**
     * 新增工单首页
     */
    public function add(){
        $this->layout();
    }

    /**
     * 新增工单
     */
    public function add1(){
        $this->layout();
    }

    /**
     * 新增工单
     */
    public function add2(){
        $this->layout();
    }

    /**
     * 新增工单
     */
    public function add3(){
        $this->layout();
    }


}