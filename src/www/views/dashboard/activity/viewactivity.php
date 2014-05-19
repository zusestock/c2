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
							<td>申请人</td>
							<td>活动名称</td>
							<td>分数</td>
							<td>申请时间</td>
						</tr>
					</thead>
					<tbody>
				<?php
					foreach ($activity as $row) { ?>
						<tr>
							<td><?=$row['username']?></td>
							<td><a href="/dashboard/viewactivitydetail/<?=$row['activity_id']?>" target="_blank"><?=$row['activity_name']?></a></td>
							<td><?=$row['grade']?></td>
							<td><?=$row['create_time']?></td>
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

