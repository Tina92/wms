<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/order.css">
<script src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/jquery.page.js"></script>
<div class="am-g ">
        <div class="am-u-sm-6">
        <div class="am-panel am-panel-primary">
            <div class="am-panel-hd">待审核工单</div>
            <ul class="am-list" id="list1">
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
            		<div class="am-u-sm-3">
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
                            <div class="am-u-sm-3">
                                <?php echo $v['add_time']?>
                            </div>
                            <div class="am-u-sm-3">
                            	<div class="am-cf">
                                <input value="<?php echo $v['id']?>" type="hidden"/>
                                <?php if($user['user_group_id'] == 1){?>
                                    <a class="am-btn am-btn-primary via" vid="3">通过</a>
                                    <a class="am-btn am-btn-danger via" vid="4">不通过</a>
                                <?php }elseif($user['user_group_id'] > 2 && $user['user_boss'] == 0){?>
                                    <a class="am-btn am-btn-primary agree" vid="1">同意</a>
                                    <a class="am-btn am-btn-danger agree" vid="2">不同意</a>
                                <?php }?>
                                <a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id=<?php echo $v['id']?>">查看</a>
                                </div>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>

            </ul>
            <div class="am-g">
            	<div class="tcdPageCode page1"></div>
            </div>
        </div>
    </div>
        <div class="am-u-sm-6">
        <div class="am-panel am-panel-warning">
            <div class="am-panel-hd">待受理工单</div>
            <ul class="am-list" id="list2">
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
            		<div class="am-u-sm-3">
            			审核时间
            		</div>
            		<div class="am-u-sm-3">
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
                            <div class="am-u-sm-3">
                                <?php echo $vv['verify_time']?>
                            </div>
                            <div class="am-u-sm-3">
                                <a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id=<?php echo $vv['id']?>">查看</a>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
            <div class="am-g">
            	<div class="tcdPageCode page2"></div>
            </div>
        </div>
    </div>
        <div class="am-u-sm-12">
        <div class="am-panel am-panel-success">
            <div class="am-panel-hd">已受理工单</div>
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
                                <a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id=<?php echo $vvv['id']?>">查看</a>
                            </div>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
            <div class="am-g">
            	<div class="tcdPageCode page3"></div>
            </div>
        </div>
    </div>
</div>
<div class="verify_mark">
	<div class="am-panel am-panel-default">
		<div class="am-panel-hd">
			不能通过的原因
		</div>
		<div class="am-panel-bd">
			<textarea class="no-via" rows="5" placeholder="请输入..."></textarea>
			<p>
				<button type="submit" class="am-btn am-btn-default submit">确认</button>
				<button type="submit" class="am-btn am-btn-default cancel">取消</button>
			</p>
		</div>
	</div>
	
</div>
<script>
	$(".page1").createPage({
        pageCount:<?php echo $count['new']?>,
        current:1,
        backFn:function(p){
            $.ajax({
            	type:"POST",
            	url:"/?g=Ticket&m=Order&a=getOrderListByPage",
            	data:{page:p,type:0},
            	dataType:"json",
            	success:function(data){
            		var result = data.data.data;
            		var html ='<li class="am-cf"><div class="am-u-sm-2">工单号</div><div class="am-u-sm-2">申请人</div><div class="am-u-sm-2">申请类型</div><div class="am-u-sm-3">申请时间</div><div class="am-u-sm-3">操作</div> </li>';
            		$.each(result, function(k, v){
			                    html+= '<li class="am-cf"><div class="am-u-sm-2">'+v.order_sn+'</div><div class="am-u-sm-2">'+v.applicants_name+'</div><div class="am-u-sm-2">';
			                    html+= (v.order_type==1)?"设计":(v.order_type==2)?"开发":"BUG";
			                    html+= '</div><div class="am-u-sm-3">'+v.add_time+'</div><div class="am-u-sm-3">';
			                    <?php if($user['user_group_id'] == 1){?>
                                    html+= '<a class="am-btn am-btn-primary via" vid="3">通过</a>'+
                                           '<a class="am-btn am-btn-danger via" vid="4">不通过</a>';
                                <?php }elseif($user['user_group_id'] > 2 && $user['user_boss'] == 0){?>
                                    html+= '<a class="am-btn am-btn-primary agree" vid="1">同意</a>'+
                                    '<a class="am-btn am-btn-danger agree" vid="2">不同意</a>';
                                <?php }?>
			                    html+= '<a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id='+ v.id +'">查看</a></div></li>';
								});
            		$("#list1").html(html);
            	}
            });
        }
    });
    $(".page2").createPage({
        pageCount:<?php echo $count['now']?>,
        current:1,
        backFn:function(p){
            $.ajax({
            	type:"POST",
            	url:"/?g=Ticket&m=Order&a=getOrderListByPage",
            	data:{page:p,type:1},
            	dataType:"json",
            	success:function(data){
            		var result = data.data.data;
            		var html ='<li class="am-cf"><div class="am-u-sm-2">工单号</div><div class="am-u-sm-2">申请人</div><div class="am-u-sm-2">申请类型</div><div class="am-u-sm-3">审核时间</div><div class="am-u-sm-3">操作</div> </li>';
            		$.each(result, function(k, v){
			                    html+= '<li class="am-cf"><div class="am-u-sm-2">'+v.order_sn+'</div><div class="am-u-sm-2">'+v.applicants_name+'</div><div class="am-u-sm-2">';
			                    html+= (v.order_type==1)?"设计":(v.order_type==2)?"开发":"BUG";
			                    html+= '</div><div class="am-u-sm-3">'+v.verify_time+'</div><div class="am-u-sm-3"><a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id='+ v.id +'">查看</a></div> </li>';
								});
            		$("#list2").html(html);
            	}
            });
        }
    });
    $(".page3").createPage({
        pageCount:<?php echo $count['end']?>,
        current:1,
        backFn:function(p){
            $.ajax({
            	type:"POST",
            	url:"/?g=Ticket&m=Order&a=getOrderListByPage",
            	data:{page:p,type:2},
            	dataType:"json",
            	success:function(data){
            		var result = data.data.data;
            		var html ='<li class="am-cf"><div class="am-u-sm-2">工单号</div><div class="am-u-sm-2">申请人</div><div class="am-u-sm-2">申请类型</div><div class="am-u-sm-2">申请时间</div><div class="am-u-sm-2">完成时间</div><div class="am-u-sm-2">操作</div> </li>';
            		$.each(result, function(k, v){
			                    html+= '<li class="am-cf"><div class="am-u-sm-2">'+v.order_sn+'</div><div class="am-u-sm-2">'+v.applicants_name+'</div><div class="am-u-sm-2">';
			                    html+= (v.order_type==1)?"设计":(v.order_type==2)?"开发":"BUG";
			                    html+= '</div><div class="am-u-sm-2">'+v.add_time+'</div><div class="am-u-sm-2">'+v.finished_time+'</div><div class="am-u-sm-2"><a class="am-btn am-btn-primary" href="/?g=Ticket&m=Order&a=info&order_id='+ v.id +'">查看</a></div> </li>';
								});
            		$("#list3").html(html);
            	}
            });
        }
    });
    
    $(document).on('click', '.agree', function() {
           var oid=$(this).siblings("input").val();
           var verify=$(this).attr("vid");
           var c=confirm("是否确认");
           if(c){
           $.ajax({
           	type:"POST",
           	url:"/?g=Ticket&m=Order&a=bossVerify",
           	data:{oid:oid,verify:verify},
            dataType:"text",
            success:function(data){
            	if(data==-1){
            		alert("参数获取失败，请刷新");
            	}
            	else if(data==0){
            		alert("审核失败，请稍候重试");
            	}
            	else if(data==1){
            		alert("审核成功");
            	}
            	else{
            		alert("请重试");
            	}
            	location.reload();
            }
           });
        }
    });
    $(document).on('click', '.via', function() {
           var oid=$(this).siblings("input").val();
           var verify=$(this).attr("vid");
           if(verify==3){
           		$.ajax({
		           	type:"POST",
		           	url:"/?g=Ticket&m=Order&a=technologyVerify",
		           	data:{oid:oid,verify:verify},
		            dataType:"text",
		            success:function(data){
		            	if(data==-1){
		            		alert("参数获取失败，请刷新");
		            	}
		            	else if(data==0){
		            		alert("审核失败，请稍候重试");
		            	}
		            	else if(data==1){
		            		alert("审核成功");
		            	}
		            	else{
		            		alert("请重试");
		            	}
		            	location.reload();
		            }
		           });
           }
           else{
           	$(".verify_mark").show();
           	$(document).on('click', '.submit', function() {
		    	var verify_mark=$(".no-via").val();
		    	$.ajax({
		           	type:"POST",
		           	url:"/?g=Ticket&m=Order&a=technologyVerify",
		           	data:{oid:oid,verify:verify,verify_mark:verify_mark},
		            dataType:"text",
		            success:function(data){
		            	if(data==-1){
		            		alert("参数获取失败，请刷新");
		            	}
		            	else if(data==0){
		            		alert("审核失败，请稍候重试");
		            	}
		            	else if(data==1){
		            		alert("审核成功");
		            	}
		            	else{
		            		alert("请重试");
		            	}
		            	location.reload();
		            }
		           });
		        $(".verify_mark").hide();
		    });
           } ;     
    });
    $(document).on('click', '.cancel', function() {
    	$(".verify_mark").hide();
    });
    
</script>