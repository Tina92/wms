<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/from.css">
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/kindeditor-all-min.js" ></script>
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/lang/zh-CN.js" ></script>
<div class="container am-padding ">
	<div class="title am-pagination-centered">
		<h2>反馈bug和建议</h2>
	</div>
	<form class="am-form ke-clearfix">
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">反馈人</div>
				<input type="text" placeholder="请输入姓名..." />
	   </div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">反馈部门</div>
				<input type="text" value="研发中心" disabled="disabled" />
		</div>
		<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">问题所在网页地址或名称</div>
				<input type="text" placeholder="请输入网址..." />
	   </div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">
				添加截图
			</div>
			<input type="file" class="am-fl" />
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-2">
				问题情况描述
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
</script>