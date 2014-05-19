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
							<label for="">活动类型</label>
						</td>
						<td>
							<?php if ($activity['type'] == '1')
									echo "强制性活动";
								  else
									echo "普通活动";
							?>
						</td>
					</tr>
					<tr>
						<td>状态</td>
						<td><?php
						if ($activity['state'] == '1') {
							echo "项目得到学校确认";
						} else if ($activity['state'] == '0') {
							echo "正在申请确认中";
						} else if ($activity['state'] == '2') {
							echo "项目申请失败";
						} else if ($activity['state'] == '3') {
							echo "名单确认中";
						} else if ($activity['state'] == '4') {
							echo "名单确认失败";
						} else if ($activity['state'] == '5') {
							echo "最后成功";
						}?></td>
					</tr>
					<?php
					if ($user_type != '2') {
						if ($activity['state'] == '3' || $activity['state'] == '5') { ?>
								<tr><td>参与学生</td><td>
								<?php
								if (@$user_attend && count($user_attend) > 0) {
									foreach ($user_attend as $user) { ?>
										<p><?=$user['username']?>&nbsp;
											<?php if ($activity['state'] == '3') { ?>
											<a href="/dashboard/deleteuserattend/<?=$activity['activity_id']?>/<?=$user['username']?>" class='remove'>删除</a>
											<?php } ?>
										</p>
									<?php } ?>
									</td>
								</tr>
							<?php
								}
						}
						if ($activity['state'] == '1' || $activity['state'] == '3') { ?>
							<tr>
								<td><?php
									if ($activity['state'] == '3')
										echo "增加参与名单";
									else
										echo "提交参与名单";
								?>
								</td>
								<td>
									<form action="/dashboard/uploadattenduser" method='post'>
										<textarea name="attenduser" rows="10" class='form-control'></textarea>
										<div class="help-block">一行一个学号!</div>
										<input type="hidden" name='activity_id' value="<?=$activity['activity_id']?>">
										<p>
										<button type='submit' class='btn blue'>提交</button>
										</p>
									</form>
								</td>
							</tr>
							<?php
							if ($activity['type'] == '1') { ?>
								<tr><td>未参加的人名单</td>
									<td>
									<form action="/dashboard/uploadnotattenduser" method='post'>
										<textarea name="attenduser" rows="10" class='form-control'></textarea>
										<div class="help-block">一行一个学号!</div>
										<input type="hidden" name='activity_id' value="<?=$activity['activity_id']?>">
										<p>
										<button type='submit' class='btn blue'>提交</button>
										</p>
									</form>
									</td>
								</tr>
							<?php }
							?>
						<?php }
					}
					?>

				</table>
			</div>
		</div>
		<?php
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