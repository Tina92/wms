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
    private $all_user,$user,$config;
    public final function __init() {
        $this->config = require PES_PATH . 'Config/config.php';
        $this->user = $_SESSION['ticket'];
        $this->user['group_name'] = $this->db('user_group')->field('user_group_name')->where("user_group_id=:user_group_id")->find(array('user_group_id'=>$this->user['user_group_id']))['user_group_name'];
        $this->assign('user',$this->user);
        $this->all_user = array();
        $res = array();
        $group_list = $this->db('user_group')->field('user_group_id, user_group_name')->where('user_group_id > :user_group_id')->select(array('user_group_id'=>1));
        $all_user = $this->db('user')->field('user_id, user_name, user_group_id')->where('user_group_id > :user_group_id')->order('user_boss ASC')->select(array('user_group_id'=>1));
        if(!empty($group_list) && is_array($group_list)){
            foreach ($group_list as $item) {
                $res[$item['user_group_id']] = $item['user_group_name'];
            }
        }
        unset($group_list);
        if(!empty($all_user) && is_array($all_user)){
            foreach($all_user as $v){
                $this->all_user[$v['user_group_id']]['group_name'] = $res[$v['user_group_id']];
                $this->all_user[$v['user_group_id']]['user_list'][$v['user_id']] = $v['user_name'];
            }
        }
        unset($res);
        $this->assign('all_user',$this->all_user);
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
                $where .= " AND (applicants_boss_id = :uid1 OR applicants_id = :uid2) ";
                $condition['uid1'] = $uid;
                $condition['uid2'] = $uid;
            }else{
                $where .= " AND applicants_id = :uid ";
                $condition['uid'] = $uid;
            }
        }
        $condition['id'] = $oid;
        $info = \Model\OrderModel::findOrderByWC($where,$condition);
        if($info[''])
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
    /**
     * 下载文件
     */
    public function downloadFile(){
        $file_name = $_GET['file_name'];     //下载文件名
        $file_dir = PES_PATH.$this->config['UPLOAD_PATH']."Order/";       //下载文件存放目录
        //检查文件是否存在
        if (! file_exists ( $file_dir . $file_name )) {
            $this->error('文件找不到');exit();
        } else {
            //打开文件
            $file = fopen ( $file_dir . $file_name, "r" );
            //输入文件标签
            Header ( "Content-type: application/octet-stream" );
            Header ( "Accept-Ranges: bytes" );
            Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );
            Header ( "Content-Disposition: attachment; filename=" . $file_name );
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread ( $file, filesize ( $file_dir . $file_name ) );
            fclose ( $file );
            exit();
        }
    }

}