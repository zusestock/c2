<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i><?=$view_title?></div>
			</div>

			<?php
			if (@$activity) { ?>
			<div class="portlet-body table">
				<table class="table table-hover">
					<thead>
						<tr>
							<td>活动名称</td>
							<td>分数</td>
							<td>申请时间</td>
							<td>结果</td>
							<td>额外操作</td>
						</tr>
					</thead>
					<tbody>
				<?php
					foreach ($activity as $row) { ?>
						<tr>
							<td><a href="/dashboard/viewactivitydetailuser/<?=$row['activity_id']?>"><?=$row['activity_name']?></a></td>
							<td><?=$row['grade']?></td>
							<td><?=$row['create_time']?></td>
							<td><?php
								switch ($row['state']) {
								case "0":
									echo "正在申请中";
									break;
								case "1":
									if ($user_type == '2')
										echo "项目申请成功";
									else
										echo "项目申请成功, 请提交名单";
									break;
								case "2":
									echo "项目申请失败";
									break;
								case "3":
									echo "名单等待确认";
									break;
								case "4":
									echo "名单确认失败";
									break;
								case "5":
									echo "名单确认成功";
									break;
								}?>
							</td>
							<td>
								<?php
								if ($row['state'] == '5') { ?>
									<a href="/dashboard/addbu/<?=$row['activity_id']?>">补增参与人</a>
								<?php } else {
									echo "无";
								}?>
							</td>
						</tr>
					<?php }
				?>
					</tbody>
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
<?php
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>

