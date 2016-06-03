<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/from.css">
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/kindeditor-all-min.js" ></script>
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/lang/zh-CN.js" ></script>
<div class="container am-padding ">
	<div class="title am-pagination-centered">
		<h2>项目开发申请单</h2>
	</div>
	<form class="am-form ke-clearfix">
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">申请人</div>
				<input type="text" placeholder="请输入姓名..." />
	   </div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">申请部门</div>
				<input type="text" value="研发中心" disabled="disabled" />
		</div>
		<div class="am-g" style="margin-bottom: 0;">
			<div class="am-u-sm-6 ">
				<div class="am-u-sm-4">紧迫程度</div>
				<input type="radio" id="first" name="degree" />
				<label for="first">紧急</label>
				<input type="radio" id="second" name="degree" />
				<label for="second">重要</label>
				<input type="radio" id="third" name="degree" />
				<label for="third">一般</label>
			</div>
			<div class="am-u-sm-6 data">
				<div class="am-u-sm-2">上线时间</div>
				<input  class="Wdate" type="text" onClick="WdatePicker()" style="width: 35%;">
			</div>
		</div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">
				添加附件
			</div>
			<input type="file" class="am-fl" />
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-2">
				设计需求描述
			</div>
			<div class="am-fl">
				<textarea id="editor_id" name="content" style="width:100%;height:300px;">
				 
				</textarea>
			</div>
		</div>
		<div class="am-pagination-centered">
			<input type="submit" value="提交" class="am-btn am-btn-primary am-topbar-btn am-btn-sm" />
		</div>
	</form>
</div>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
         $(document).on("change","input[type='radio']",function(){
        	
        	if($("#first").get(0).checked){
        		$(".data").show();
        	}else{
        		$(".data").hide();
        	}
        });
</script>