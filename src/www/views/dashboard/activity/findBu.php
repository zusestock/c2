<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>补交申请</div>
			</div>
			<div class="portlet-body">
				<?php
					if (@$Bu && count($Bu) > 0) { ?>
						<table class="table table-hover">
							<thead>
								<tr><td>活动名称</td><td>活动申请人</td><td>活动时间</td><td>结果</td></tr>
							</thead>
							<tbody>
							<?php foreach ($Bu as $row) { ?>
								<tr>
									<td><a href="/dashboard/viewactivitydetail/<?=$row['activity_id']?>"><?=$row['activity_name']?></a></td><td><?=$row['realname']?></td>
									<td><?=$row['create_time']?></td>
									<td>
										<a href="/dashboard/confirmBu/<?=$row['activity_id']?>">确认</a>
										<a href="/dashboard/rejectBu/<?=$row['activity_id']?>">驳回</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					<?php }
					else { ?>
						<div class="alert alert-warning">暂时没有申请补交</div>
					<?php } ?>
			</div>

		</div>
	</div>
</div>
<script src="/media/js/form-components.js"></script>
<script type="text/javascript" src="/media/js/bootstrap-datetimepicker.js"></script>

<?php
include(VIEWPATH."dashboard/include_js.php");
?>
	<script>
		jQuery(document).ready(function() {
		   // initiate layout and plugins
		   // FormComponents.init();
		});
	</script>
<?php
include(VIEWPATH."dashboard/root_footer.php");
?>

