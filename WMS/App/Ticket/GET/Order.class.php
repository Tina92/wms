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

    public $condition = 'WHERE 1 = 1', $param = [];

    /**
     * 工单
     */
    public function index()
    {
        $this->layout();
    }

    /**
     * 新增工单
     */
    public function add()
    {
        $this->layout();
    }
}