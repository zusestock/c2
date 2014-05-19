<?php
include(VIEWPATH."dashboard/dashboard_header.php");
if (@$success) {
	echo "<div class='alert alert-success'>确认成功！</div>";
} else { ?>
<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>活动详情</div>
			</div>
			<?php
			if (@$activity) { ?>
			<div class="portlet-body table">
				<table class="table table-hover">
					<tr>
						<td>
							<label for="">申请人</label>
						</td>
						<td>
							<span><?=$activity['username']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">活动名称</label>
						</td>
						<td>
							<span><?=$activity['activity_name']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">申请分数</label>
						</td>
						<td>
							<span><?=$activity['grade']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">申请时间点</label>
						</td>
						<td>
							<span><?=$activity['create_time']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">活动起始时间</label>
						</td>
						<td>
							<span><?=$activity['duration_start']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">活动结束时间</label>
						</td>
						<td>
							<span><?=$activity['duration_end']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">联系邮箱</label>
						</td>
						<td>
							<span><?=$activity['contact_email']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">联系电话</label>
						</td>
						<td>
							<span><?=$activity['contact_phone']?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">活动简介</label>
						</td>
						<td>
							<?=$activity['short_intro']?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="">附件下载</label>
						</td>
						<td>
							<span><a href="/dashboard/download/<?=$activity['attachment']?>" target="_blank">查看申请说明</a></span>
						</td>
					</tr>
					<?php
					if ($activity['state'] == '3') {
						if (@$user_attend) { ?>
							<tr><td>参与学生</td><td>
							<?php
							foreach ($user_attend as $user) { ?>
								<p>
									<a href="/dashboard/viewstudentdetail/<?=$user['username']?>" target="_blank"><?=$user['realname']?></a>
								</p>
							<?php } ?>
							</td>
							</tr>
						<?php
						}
					}
					if (@$buxuan && count($buxuan) > 0) { ?>
						<tr>
							<td>补增的人</td><td>
						<?php
						foreach ($buxuan as $row) { ?>
							<p><a href="/dashboard/viewstudentdetail/<?=$row['username']?>"><?=$row['username']?></a></p>
						<?php } ?>
							</td>
						</tr>
					<?php }
					?>
				</table>
			</div>
		</div>
			<?php if (!@$success) {
				if ($activity['state'] == '0') { ?>
				<div class="span12">
					<a type='btn' class='btn blue' href="/dashboard/confirmactivitystateone/<?=$activity['activity_id']?>/1">确认</a>
					<a type='btn' class='btn green' href="/dashboard/confirmactivitystateone/<?=$activity['activity_id']?>/0">驳回</a>
				</div>
				<?php
				} else if ($activity['state'] == '3'){ ?>
				<div class="span12">
					<a type='btn' class='btn blue' href="/dashboard/confirmactivitystatetwo/<?=$activity['activity_id']?>/1">确认</a>
					<a type='btn' class='btn green' href="/dashboard/confirmactivitystatetwo/<?=$activity['activity_id']?>/0">驳回</a>
				</div>
			<?php }
			 	}
		} else { ?>
			<div class="span12">
				<div class="alert alert-info">暂时没有活动</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php }
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>
