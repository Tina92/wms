<?php
/**
 * .
 * User: YaoJie
 * Date: 2016/6/3
 * Time: 08:42
 */

namespace Slice\Ticket\UpdateField;

/**
 * 执行更新用户组字段的动作
 * Class Login
 * @package Slice\Ticket
 */
class UpdateUserField extends \Core\Slice\Slice{

    public function before() {
    }

    /**
     * 更新模型字段中，绑定了用户组ID的字段选项
     */
    public function after() {
        $userList = \Model\Content::listContent(['table' => 'user']);
        $user = [];
        $user['顶级管理员'] = "0";
        foreach($userList as $value){
            $user[$value['user_name']] = $value['user_id'];
        }
        $this->db('field')->where('field_name = :field_name')->update(['field_option' => json_encode($user), 'noset' => ['field_name' => 'boss'] ]);
    }


}