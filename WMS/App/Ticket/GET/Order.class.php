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
        //print_r($user);exit;
    }

    public function index(){
        $ui = isset($_SESSION['ticket']['user_id']) ? (empty($_SESSION['ticket']['user_id']) ? 0 : intval($_SESSION['ticket']['user_id'])) : 0;
        $ut = isset($_SESSION['ticket']['user_group_id']) ? (empty($_SESSION['ticket']['user_group_id']) ? 0 : intval($_SESSION['ticket']['user_group_id'])) : 0;
        $ub = isset($_SESSION['ticket']['user_boss']) ? (empty($_SESSION['ticket']['user_boss']) ? 0 : intval($_SESSION['ticket']['user_boss'])) : 0;
        $pa = isset($_GET['page']) ? intval($_GET['page']) : 1;

        $order_listA = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 0, $pa, 10);
        $order_listB = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 1, $pa, 10);
        $order_listC = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 2, $pa, 10);
        $this->assign('new',$order_listA);
        $this->assign('now',$order_listB);
        $this->assign('end',$order_listC);
        //print_r($order_listA);exit;
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