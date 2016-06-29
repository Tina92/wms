<link rel="stylesheet" href="<?= DOCUMENT_ROOT; ?>/Theme/assets/css/sass/sass/info.css">
<div class="container am-padding ">
	<a class="am-margin-right-xs am-text-danger" href="/?g=Ticket&m=Order&a=index"><i class="am-icon-reply"></i> 工单列表</a>
	<div class="title am-pagination-centered">
		<h2><?php
			switch($info['order_type']){
				case 1 :
					echo "美工设计申请单";
					break;
				case 2:
					echo "项目开发申请单";
					break;
				case 3:
					echo "反馈BUG和建议";
					break;
				default :
					echo "未知类型工单";
					break;
			}
			?></h2>
	</div>
	<div class="am-form">
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">申请人</div>
			<div class="am-u-sm-9">
				<?=$info['applicants_name']; ?>
			</div>
	    </div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">申请部门</div>
			<div class="am-u-sm-9"><?=$info['applicants_dep_name'];?></div>
		</div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">工单号</div>
			<div class="am-u-sm-9"><?=$info['order_sn']; ?></div>
		</div>
		<?php if($info['cc']){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">抄送用户</div>
				<div class="am-u-sm-9"><?=$info['cc']; ?>
				</div>
			</div>
		<?php }?>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">工单类型</div>
			<div class="am-u-sm-9"><?php echo ($info['order_type']==1)?"设计":(($info['order_type']==2)?"开发":"BUG")?></div>
		</div>
		<?php if($info['order_type'] == 3){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">网页地址或名称</div>
				<div class="am-u-sm-9"><?=$info['bug_url']; ?></div>
			</div>
		<?php }else{?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">紧迫程度</div>
				<?php if($info['urgency_type'] == 2){?>
					<div class="am-u-sm-3"><?php echo ($info['urgency_type']==1)?"重要":(($info['urgency_type']==2)?"紧急":"一般")?></div>
					<div class="am-u-sm-6">
						<div class="am-u-sm-4">
							上线时间
						</div>
						<div class="am-u-sm-8">
							<?=$info['finish_time']; ?>
						</div>
					</div>
				<?php }else{?>
					<div class="am-u-sm-9"><?php echo ($info['urgency_type']==1)?"重要":(($info['urgency_type']==2)?"紧急":"一般")?></div>
				<?php }?>
			</div>
			<?php if($info['urgency_type'] == 2){?>
				<div class="am-g am-u-sm-12">
					<div class="am-u-sm-3">紧迫理由</div>
					<div class="am-u-sm-9"><?=$info['urgency_mark']; ?></div>
				</div>
			<?php }?>
		<?php }?>
		<?php if($info['order_type'] == 1){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">设计类型</div>
				<div class="am-u-sm-9">
					<?php
					if($info['design_type']){
						$design_type = explode(",",substr($info['design_type'],1,-1));
						$vs = "";
						foreach($design_type as $k => $v){
							switch($v){
								case 1:
									$vs .= " <span>产品详情页</span> ";
									break;
								case 2:
									$vs .= " <span>店招</span> ";
									break;
								case 3:
									$vs .= " <span>网页专题</span> ";
									break;
								case 4:
									$vs .= " <span>首页幻灯</span> ";
									break;
								case 5:
									$vs .= " <span>聚宝盆</span> ";
									break;
								case 6:
									$vs .= " <span>楼层轮播</span> ";
									break;
								case 7:
									$vs .= " <span>楼层广告</span> ";
									break;
								case 8:
									$vs .= " <span>热门推荐</span> ";
									break;
								case 9:
									$vs .= " <span>其他</span> ";
									break;
								default:
									$vs .= " <span>其他</span> ";
									break;
							}
						}
						echo $vs;
					}
					?>
				</div>

			</div>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">
					广告位或者轮播图排期
				</div>
				<div class="am-u-sm-9">
					<span><?=$info['adv_start_time']?></span>
					<span>~</span>
					<span><?=$info['adv_end_time']?></span>
				</div>
			</div>
		<?php }?>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">
				查看附件
			</div>
			<?php if($info['attachment']){?>
				<div class="am-u-sm-9">
					<a href="/?g=Ticket&m=Order&a=downloadFile&file_name=<?php echo $info['attachment']?>">下载附件</a>
				</div>
			<?php }else{?>
				<div class="am-u-sm-9">
					<a>没有上传附件</a>
				</div>
			<?php }?>
		</div>
		<div class="am-g  am-u-sm-12">
			<div class="am-u-sm-3">
				设计需求描述
			</div>
			<div class="am-u-sm-9">
				<textarea  id="wznr_html" style="display:none" > 
					<!--这里是从数据库读取的文章内容，实际是HTML代码。-->
					<a><?=$info['requirement']?></a>
				</textarea>
				<div id="jk" height="410"></div>
			</div>
		</div>
		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">
				工单状态
			</div>
			<div class="am-u-sm-9">
				<?php
				if($info['delete_state'] == 1){
					echo "工单已经删除";
				}else{
					if($info['order_state'] == 0){
						if($info['verify_type'] == 4){
							echo "技术部审核不通过";
						}elseif($info['verify_type'] == 3){
							echo "工单正在进行中";
						}elseif($info['verify_type'] == 2){
							echo "工单完结，领导审阅不通过，审核领导：".$info['boss_name'];
						}elseif($info['verify_type'] == 1){
							echo "待技术部领导审核";
						}else{
							echo "待直属领导审阅，直属领导：".$info['boss_name'];
						}
					}else{
						if($info['finished_time'] != "0000-00-00 00:00:00" && !empty($info['finished_time'])){
							echo "已经于 ".$info['finished_time']." 完成";
						}
					}
				}
				?>
			</div>
		</div>


		<div class="am-g am-u-sm-12">
			<div class="am-u-sm-3">
				申请时间
			</div>
			<div class="am-u-sm-9">
				<span><?=$info['add_time']?></span>
			</div>
		</div>
		<?php if($info['verify_type'] > 0 && $info['boss_verifier'] > 0){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">
					领导批阅时间
				</div>
				<div class="am-u-sm-3">
					<span><?=$info['boss_verify_time']?></span>
				</div>
				<div class="am-u-sm-6">
					<div class="am-u-sm-4">
						批阅意见
					</div>
					<div class="am-u-sm-8">
						<?php if($info['verify_type'] == 2){ echo "不同意"; }else{echo "同意";}?>
					</div>
				</div>
			</div>
		<?php }?>
		<?php if($info['verify_type'] > 2 && $info['verifier_id'] > 0){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">
					技术部审核时间
				</div>
				<div class="am-u-sm-3">
					<span><?=$info['verify_time']?></span>
				</div>
				<div class="am-u-sm-6">
					<div class="am-u-sm-4">
						审核状态
					</div>
					<div class="am-u-sm-4">
						<?php if($info['verify_type'] == 4){ echo "不通过"; }else{echo "通过";}?>
					</div>
					<div class="am-u-sm-4">
						<?php if($info['verify_mark'] != null){ echo $info['verify_mark'];}?>
					</div>
				</div>
			</div>
		<?php }?>
		<?php if($info['order_state'] == 1){?>
			<div class="am-g am-u-sm-12">
				<div class="am-u-sm-3">
					工单完成时间
				</div>
				<div class="am-u-sm-9">
					<span><?=$info['finished_time']?></span>
				</div>
			</div>
		<?php }?>
	</div>
</div>
<script>
    $("#jk").html($("#wznr_html").val());       
</script>