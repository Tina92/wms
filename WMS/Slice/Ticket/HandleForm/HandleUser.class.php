<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Ticket\HandleForm;

/**
 * 处理后台 用户添加/编辑提交过来的密码表单
 * @package Slice\Ticket
 */
class HandleUser extends \Core\Slice\Slice {

    public function before() {

        if (METHOD == 'POST') {
            $this->isP('password', '请填写密码');
            $user_account = $this->isP('account', '请填写会员账号');
            $user_mobile = $this->isP('mobile', '请填写手机号');
            $user_name = $this->isP('name', '请填写会员名称');
            if (strlen ( $user_mobile ) != 11 || ! preg_match ( '/^1[3|4|5|7|8][0-9]\d{4,8}$/', $user_mobile )) {
                $this->error('手机号格式不正确');
            }
            $only = $this->db('user')->where('user_account = :user_account AND user_status = 1 ')->find(array('user_account'=>$user_account));
            if($only){
                $this->error('该会员账号已经存在，请使用其它会员账号');
            }else{
                $only = $this->db('user')->where('user_mobile = :user_mobile AND user_status = 1 ')->find(array('user_mobile'=>$user_mobile));
                if($only){
                    $this->error('该手机号已经存在，请寻求技术部管理员协助');
                }else{
                    $only = $this->db('user')->where('user_name = :user_name AND user_status = 1 ')->find(array('user_name'=>$user_name));
                    if($only){
                        $this->error('该会员名称已经存在，请寻求技术部管理员协助');
                    }
                }
            }
        }
        if (METHOD == 'PUT'){
            $user_account = $this->isP('account', '请填写会员账号');
            $user_mobile = $this->isP('mobile', '请填写手机号');
            $user_name = $this->isP('name', '请填写会员名称');
            $user_id = $this->isP('id');
            if (strlen ( $user_mobile ) != 11 || ! preg_match ( '/^1[3|4|5|7|8][0-9]\d{4,8}$/', $user_mobile )) {
                $this->error('手机号格式不正确');
            }
            $only = $this->db('user')->where('user_account = :user_account AND user_id <> :user_id AND user_status = 1 ')->find(array('user_account'=>$user_account,'user_id'=>$user_id));
            if($only){
                $this->error('该会员账号已经存在，请使用其它会员账号');
            }else{
                $only = $this->db('user')->where('user_mobile = :user_mobile AND user_id <> :user_id AND user_status = 1 ')->find(array('user_mobile'=>$user_mobile,'user_id'=>$user_id));
                if($only){
                    $this->error('该手机号已经存在，请寻求技术部管理员协助');
                }else{
                    $only = $this->db('user')->where('user_name = :user_name AND user_id <> :user_id AND user_status = 1 ')->find(array('user_name'=>$user_name,'user_id'=>$user_id));
                    if($only){
                        $this->error('该会员名称已经存在，请寻求技术部管理员协助');
                    }
                }
            }
        }
        if (empty($_POST['password'])) {
            $_POST['password'] = \Model\Content::findContent('user', $_POST['id'], 'user_id')['user_password'];
        } else {
            $_POST['password'] = (string)\Core\Func\CoreFunc::generatePwd($this->p('password'));
        }

    }

    public function after() {
    }


}