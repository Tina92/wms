<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/order.css">
<div class="am-g ">
        <div class="am-u-sm-6">
        <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">新提交工单</div>
            <ul class="am-list">
                <li class="am-cf">
                    <div class="am-u-sm-2">
                        工单号
                    </div>
                    <div class="am-u-sm-2">
            			申请人
            		</div>
            		<div class="am-u-sm-2">
            			申请类型
            		</div>
            		<div class="am-u-sm-2">
            			申请时间
            		</div>
            		<div class="am-u-sm-2">
            			操作
            		</div>
                </li>
                <?php if(!empty($new)){?>
                    <?php foreach($new as $v){?>
                        <li class="am-cf">
                            <div class="am-u-sm-2">
                                <?php echo $v['order_sn']?>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $v['applicants_name']?>
                            </div>
                            <div class="am-u-sm-2">
                                <a><?php echo ($v['order_type']==1)?"设计":(($v['order_type']==2)?"开发":"BUG")?></a>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $v['add_time']?>
                            </div>
                            <div class="am-u-sm-2">
                                <?php if($user['user_group_id'] == 1){?>
                                    <a class="am-btn am-btn-primary">通过</a>
                                    <a class="am-btn am-btn-danger">不通过</a>
                                <?php }elseif($user['user_group_id'] > 2 && $user['user_boss'] == 0){?>
                                    <a class="am-btn am-btn-primary">同意</a>
                                    <a class="am-btn am-btn-danger">不同意</a>
                                <?php }?>
                                <a class="am-btn am-btn-primary">查看</a>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>

            </ul>
        </div>
    </div>
        <div class="am-u-sm-6">
        <div class="am-panel am-panel-warning">
            <div class="am-panel-hd">进行中的工单</div>
            <ul class="am-list">
                <li class="am-cf">
                    <div class="am-u-sm-2">
                        工单号
                    </div>
            		<div class="am-u-sm-2">
            			申请人
            		</div>
            		<div class="am-u-sm-2">
            			申请类型
            		</div>
            		<div class="am-u-sm-2">
            			审核时间
            		</div>
            		<div class="am-u-sm-2">
            			操作
            		</div>
                </li>
                <?php if(!empty($now)){?>
                    <?php foreach($now as $vv){?>
                        <li class="am-cf">
                            <div class="am-u-sm-2">
                                <?php echo $vv['order_sn']?>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $vv['applicants_name']?>
                            </div>
                            <div class="am-u-sm-2">
                                <a><?php echo ($vv['order_type']==1)?"设计":(($vv['order_type']==2)?"开发":"BUG")?></a>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $vv['verify_time']?>
                            </div>
                            <div class="am-u-sm-2">
                                <a>重新选择</a>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
        <div class="am-u-sm-12">
        <div class="am-panel am-panel-success">
            <div class="am-panel-hd">已完成工单</div>
            <ul class="am-list">
                <li class="am-cf">
                    <div class="am-u-sm-2">
                        工单号
                    </div>
            		<div class="am-u-sm-2">
            			申请人
            		</div>
            		<div class="am-u-sm-2">
            			申请类型
            		</div>
            		<div class="am-u-sm-2">
            			申请时间
            		</div>
            		<div class="am-u-sm-2">
            			完成时间
            		</div>
            		<div class="am-u-sm-2">
            			操作
            		</div>
                </li>
                <?php if(!empty($end)){?>
                    <?php foreach($end as $vvv){?>
                        <li class="am-cf">
                            <div class="am-u-sm-2">
                                <?php echo $vvv['order_sn']?>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $vvv['applicants_name']?>
                            </div>
                            <div class="am-u-sm-2">
                                <a><?php echo ($vvv['order_type']==1)?"设计":(($vvv['order_type']==2)?"开发":"BUG")?></a>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $vvv['add_time']?>
                            </div>
                            <div class="am-u-sm-2">
                                <?php echo $vvv['finished_time']?>
                            </div>
                            <div class="am-u-sm-2">
                                <a>删除</a>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>