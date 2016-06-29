<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/from.css">
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/js/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/kindeditor-all-min.js" ></script>
<script type="text/javascript" src="<?= DOCUMENT_ROOT; ?>/Theme/assets/editor/lang/zh-CN.js" ></script>
<div class="container am-padding ">
	<div class="title am-pagination-centered">
		<h2>反馈bug和建议</h2>
	</div>
	<form class="am-form ke-clearfix" action="/?g=Ticket&m=Order&a=index" method="post" enctype="multipart/form-data">
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">反馈人</div>
			<input type="text" name="applicants_name" value="<?=$user['user_name']; ?>" readonly="readonly"/>
	   	</div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">反馈部门</div>
			<input type="text" value="<?=$user['group_name'];?>" disabled="disabled" />
		</div>
		<?php if($all_user){$i=1;?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-2">抄送</div>
				<div class="am-fl am-u-sm-9">
					<ul class="person"></ul>
					<div class="company am-cf">
						<div class="tab am-cf">
							<ul class="am-nav am-nav-tabs">
								<?php foreach ($all_user as $key => $v) {?>
									<li class="depart <?php if($i==1){echo "am-active";}?>" id="department_<?=$key?>">
										<a href="javascript:void(0)"><?=$v['group_name']?></a>
									</li>
								<?php $i++; }?>
							</ul>
						</div>
						<div class="item">
							<?php foreach ($all_user as $kk => $vv) {?>
								<div class="choice department_<?=$kk?>">
								<ul>
									<?php if(!empty($vv['user_list']) && is_array($vv['user_list'])){?>
										<?php foreach($vv['user_list'] as $kkk => $vvv){?>
											<li class="am-fl">
												<label>
													<input type="checkbox" value="<?=$kkk?>" un="<?=$vvv?>"/>
													<span><?=$vvv?></span>
												</label>
											</li>
										<?php }?>
									<?php }?>
								</ul>
							</div>
							<?php }?>

						</div>
					</div>
				</div>
			</div>
		<?php }?>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">问题所在网页地址或名称</div>
			<input name="bug_url" type="text" placeholder="请输入网址..." />
		</div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-2">
				添加附件
			</div>
			<input name="attachment" type="file" class="am-fl" />
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-2">
				问题情况描述
			</div>
			<div class="am-u-sm-9">
				<textarea id="editor_id" name="requirement" style="width:100%;height:300px;">
				</textarea>
			</div>
		</div>
		<div class="am-pagination-centered">
			<input type="submit" value="提交" class="am-btn am-btn-primary am-topbar-btn am-btn-sm" />
		</div>
		<input type="hidden" name="order_type" value="3">
		<input type="hidden" name="applicants_id" value="<?=$user['user_id']; ?>" />
		<input type="hidden" name="applicants_boss_id" value="<?=$user['user_boss']; ?>" />
		<input type="hidden" name="applicants_dep_id" value="<?=$user['user_group_id']; ?>" />
	</form>
</div>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id', {
                	items : ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', '|', 'selectall', 'clearhtml','quickformat','|',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|','table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
					uploadJson : "./php/upload_json.php",//图片上传后的处理地址
					fileManager:"./php/file_manager_json.php",
					allowFileManager : true
				});
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
</script>