<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/from.css">
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/kindeditor-all-min.js" ></script>
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/lang/zh-CN.js" ></script>
<div class="container am-padding ">
	<div class="title am-pagination-centered">
		<h2>美工设计申请单</h2>
	</div>
	<form class="am-form ke-clearfix" action="/?g=Ticket&m=Order&a=index" method="post" enctype="multipart/form-data">
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">申请人</div>
				<input type="text" name="applicants_name" value="<?=$user['user_name']; ?>" readonly="readonly" />
	   </div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">申请部门</div>
				<input type="text" value="<?=$user['group_name'];?>" disabled="disabled" />
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">抄送</div>
				<div class="am-fl am-u-sm-9">
					<ul class="person">
						
					</ul>
					<div class="company am-cf">
						<div class="tab am-cf">
							<ul class="am-nav am-nav-tabs">
								<li class="depart am-active" id="eco">
									<a href="javascript:void(0)">财务部</a>
								</li>
								<li class="depart" id="hr">
									<a href="javascript:void(0)">人事部</a> 
								</li>
								<li class="depart" id="market">
									<a href="javascript:void(0)">市场营销</a> 
								</li>
							</ul>
						</div>
						<div class="item">
							<div class="choice eco">
								<ul>
									<li class="am-fl">
										<label>
											<input type="checkbox" value="1" un="周艳婷"/>
											<span>周艳婷</span>
										</label>
									</li>
									<li class="am-fl">
										<label>
											<input type="checkbox" value="2" un="周aaa"/>
											<span>周aaa</span>
										</label>
									</li>
									<li class="am-fl">
										<label>
											<input type="checkbox" value="3" un="周艳bb"/>
											<span>周艳bb</span>
										</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="am-g" style="margin-bottom: 0;">
			<div class="am-u-sm-6 ">
				<div class="am-u-sm-4">紧迫程度</div>
				<input type="radio" id="third" name="urgency_type" value="0" checked />
				<label for="third">一般</label>
				<input type="radio" id="second" name="urgency_type" value="1" />
				<label for="second">重要</label>
				<input type="radio" id="first" name="urgency_type" value="2" />
				<label for="first">紧急</label>
			</div>
			<div class="am-u-sm-6 data">
				<div class="am-u-sm-2">上线时间</div>
				<input name="finish_time"  class="Wdate" type="text" onClick="WdatePicker({minDate:'%y-%M-%d'})" style="width: 35%;">
			</div>
			
		</div>
		<div class="am-g am-u-sm-12 data">
				<div class="am-u-sm-2">
					紧迫理由
				</div>
					<input type="text" class="required" />
			</div>
		<div class="am-g am-u-sm-12">
		    <div class="am-u-sm-2">设计类型</div>
		    <div class="am-fl design">
		        <input type="checkbox" name="design_type[1]" />
		        <label>产品详情页</label>&nbsp;
		        <input type="checkbox" name="design_type[2]" />
		        <label>店招</label>&nbsp;
		        <input type="checkbox" name="design_type[3]" />
		        <label>网页专题</label>&nbsp;
		        <input type="checkbox" name="design_type[4]" class="hd" />
		        <label>首页幻灯</label>&nbsp;
		        <input type="checkbox" name="design_type[5]" />
		        <label>聚宝盆</label>&nbsp;
		        <input type="checkbox" name="design_type[6]" class="hd" />
		        <label>楼层轮播</label>&nbsp;
		        <input type="checkbox" name="design_type[7]" />
		        <label>楼层广告</label>&nbsp;
		        <input type="checkbox" name="design_type[8]" />
		        <label>热门推荐</label>&nbsp;
		        <input type="checkbox" name="design_type[9]" />
		        <label>其他</label>
		    </div>
		    
		</div>
		<div class="am-g am-u-sm-12 Schedules">
		    	<div class="am-u-sm-2">
		    		广告位或者轮播图排期
		    	</div>
		    	<div class="am-u-sm-9">
		    		<div class="am-u-sm-5">
		    		<input name="adv_start_time" id="d4311" class="Wdate" type="text" onClick="WdatePicker({minDate:'%y-%M-%d',maxDate:'#F{$dp.$D(\'d4312\')}'})">
		    		</div>
		    		<div class="am-u-sm-1">~</div>
		    		<div class="am-u-sm-5">
		    		<input name="adv_end_time" id="d4312" class="Wdate" type="text" onClick="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')||\'%y-%M-%d\'}'})">
		    		</div>
		    	</div>
		    </div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">
				添加附件
			</div>
			<input type="file" class="am-fl" name="attachment" />
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-2">
				设计需求描述
			</div>
			<div class="am-u-sm-9">
				<textarea id="editor_id" name="requirement" style="width:100%;height:300px;">
				 
				</textarea>
			</div>
		</div>
		<div class="am-pagination-centered">
			<input type="submit" value="提交" class="am-btn am-btn-primary am-topbar-btn am-btn-sm" />
		</div>
		<input type="hidden" name="order_type" value="1">
		<input type="hidden" name="applicants_id" value="<?=$user['user_id']; ?>" />
		<input type="hidden" name="applicants_boss_id" value="<?=$user['user_boss']; ?>" />
		<input type="hidden" name="applicants_dep_id" value="<?=$user['user_group_id']; ?>" />
	</form>
</div>
<script>
        KindEditor.ready(function(K) {
//              window.editor = K.create('#editor_id');
                window.editor = K.create('#editor_id', {
                	items : ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', '|', 'selectall', 'clearhtml','quickformat','|',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|',  'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
					uploadJson : "./php/upload_json.php",//图片上传后的处理地址
					fileManager:"./php/file_manager_json.php",
					allowFileManager : true
				});
        });
        $(document).on("change","input[type='radio']",function(){
        	
        	if($("#first").get(0).checked){
        		$(".data").show();
        	}else{
        		$(".data").hide();
        	}
        });
        $(document).on("change",".design input[type='checkbox']",function(){
        	if($(this).hasClass("hd")){
	        	if($(".hd").eq(0).get(0).checked||$(".hd").eq(1).get(0).checked){
	        		$('.Schedules').show();
	        	}else{
	        		$('.Schedules').hide();
	        	}
        	}
        });
        $(".depart").click(function(){
        	var id=$(this).attr("id");
        	$(".choice").hide();
        	$("."+id).show();
        	$(".depart").removeClass("am-active");
        	$(this).addClass("am-active");
        });
        
         $(document).on("change",".choice input[type='checkbox']",function(){
        	if($(this).is(':checked')){
        		var html = "<span vid='"+$(this).val()+"'>"+$(this).attr('un')+"</span>";
        		$('.person').append(html);
        	}else{
        		$("span[vid='"+$(this).val()+"']").remove();
        	}
        });
        $(document).on("click","input[type='submit']",function(){
        	if($("#first").is(':checked')){
        		if($(".required").val()==null||$(".required").val()==""){
	        		alert("请输入紧迫理由");
	        		return false;
	        	}
        	}
        	
        });
</script>