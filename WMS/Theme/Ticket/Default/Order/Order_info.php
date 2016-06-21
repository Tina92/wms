<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/info.css">
<div class="container am-padding ">
	<div class="title am-pagination-centered">
		<h2>美工设计申请单</h2>
	</div>
	<div class="am-form">
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">申请人</div>
				<div class="am-u-sm-9">
					<?=$user['user_name']; ?>
				</div>
	   </div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">申请部门</div>
				<div class="am-u-sm-9"><?=$user['group_name'];?></div>
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">工单号</div>
				<div class="am-u-sm-9">ASAF1466387038</div>
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">工单状态</div>
				<div class="am-u-sm-9">新提交</div>
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">网页地址或名称</div>
				<div class="am-u-sm-9">http://www.w.com/?g=Ticket&m=Order&a=add3</div>
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">紧迫程度</div>
				<div class="am-u-sm-3">紧急</div>
			    <div class="am-u-sm-6">
			    	<div class="am-u-sm-4">
			    		上线时间
			    	</div>
			        <div class="am-u-sm-8">
			        	2016-06-21
			        </div>
			    </div>
			
		</div>
		<div class="am-g am-u-sm-12">
		    <div class="am-u-sm-3">设计类型</div>
		    <div class="am-u-sm-9">
		        <span>产品详情页</span>
		        <span>店招</span>
		        <span>网页专题</span>
		    </div>
		    
		</div>
		<div class="am-g am-u-sm-12">
		    	<div class="am-u-sm-3">
		    		广告位或者轮播图排期
		    	</div>
		    	<div class="am-u-sm-9">
		    		<span>2016-06-21</span>
		    		<span>~</span>
		    		<span>2016-06-27</span>   
		    	</div>
		    </div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">
				查看附件
			</div>
			<div class="am-u-sm-9">
			<a>下载</a>
			</div>
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-3">
				设计需求描述
			</div>
			<div class="am-u-sm-9">
				<textarea  id="wznr_html" style="display:none" > 
					<!--这里是从数据库读取的文章内容，实际是HTML代码。-->
					<a>123435</a>
				</textarea>
				<div id="jk" height="410"></div>
			</div>
		</div>
	</div>
</div>
<script>
    $("#jk").html($("#wznr_html").val());       
</script>