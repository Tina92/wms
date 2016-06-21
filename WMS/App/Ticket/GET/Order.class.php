<?php
/**
 * .
 * User: YaoJie
 * Date: 2016/6/2
 * Time: 15:58
 */
namespace App\Ticket\GET;
use App\Ticket\PUT\Model;

/**
 * 工单
 * Class Order
 * @package App\Ticket\GET
 */
class Order extends \App\Ticket\Common
{
    public final function __init() {
        $this->user = $_SESSION['ticket'];
        $this->user['group_name'] = $this->db('user_group')->field('user_group_name')->where("user_group_id=:user_group_id")->find(array('user_group_id'=>$this->user['user_group_id']))['user_group_name'];
        $this->assign('user',$this->user);
    }

    public function index(){
        $ui = isset($this->user['user_id']) ? (empty($this->user['user_id']) ? 0 : intval($this->user['user_id'])) : 0;
        $ut = isset($this->user['user_group_id']) ? (empty($this->user['user_group_id']) ? 0 : intval($this->user['user_group_id'])) : 0;
        $ub = isset($this->user['user_boss']) ? (empty($this->user['user_boss']) ? 0 : intval($this->user['user_boss'])) : 0;
        //$pa = isset($_GET['page']) ? intval($_GET['page']) : 1;

        $order_listA = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 0, 1, 10);
        $order_listB = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 1, 1, 10);
        $order_listC = \Model\OrderModel::getUserOrderList($ui, $ut, $ub, 2, 1, 10);
        $this->assign('new',$order_listA['data']);
        $this->assign('now',$order_listB['data']);
        $this->assign('end',$order_listC['data']);
        $this->assign('count',array("new"=>$order_listA['count'],"now"=>$order_listB['count'],"end"=>$order_listC['count']));
        $this->layout();
    }

    public function info(){
        $oid = $this->isG("order_id", "系统参数丢失，请刷新页面重试");
        $uid = isset($this->user['user_id']) ? $this->user['user_id'] : $_SESSION['ticket']['user_id'];
        $ut = isset($this->user['user_group_id']) ? $this->user['user_group_id'] : $_SESSION['ticket']['user_group_id'];
        $ub = isset($this->user['user_boss']) ? $this->user['user_boss'] : $_SESSION['ticket']['user_boss'];
        $where = " id = :id ";
        if($ut > 2){
            if($ub == 0){
                $where .= " AND applicants_boss_id = :uid ";
            }else{
                $where .= " AND applicants_id = :uid ";
            }
        }
        $condition['id'] = $oid;
        $condition['uid'] = $uid;
        $info = \Model\OrderModel::findOrderByWC($where,$condition);
        $this->assign('info',$info);
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