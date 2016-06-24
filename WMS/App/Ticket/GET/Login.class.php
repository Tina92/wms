<?php
/**
 * WMS for PHP 5.4+
 *
 * Copyright (c) 2014 WMS (http://www.WMS.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */

namespace App\Ticket\GET;

class Login extends \App\Ticket\Common{

    public function index(){
        if(isset($_SESSION['ticket']) && $_SESSION['ticket']['user_id'] > 0){
            header("location:".$this->url('Ticket-Order-index'));
        }else {
            $this->display();
        }
    }

    public function logout(){
        session_destroy();
        $this->success('您已安全退出', $this->url('Ticket-Login-index'));
    }

}