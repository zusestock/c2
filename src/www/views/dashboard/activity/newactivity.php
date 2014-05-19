<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<?php
if (@$success) {
	echo "<div class='alert alert-success'>创建成功</div>";
}
if (@$error) {
	echo "<div class='alert alert-warning'>".$error."</div>";
} ?>

<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>提交活动申请</div>
			</div>
			<div class="portlet-body form">
				<form action="/dashboard/newactivity" class='form_datetime' method='post' enctype="multipart/form-data">
					<div class="control-group">
						<label class="control-label">活动名称</label>
						<div class="controls">
							<input type="text" class="span6 m-wrap" name="activity_name">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">申请人</label>
						<div class="controls">
							<input type="text" class="span6 m-wrap" name="username">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">申请分数</label>
						<div class="controls">
							<input type="text" class="span6 m-wrap" name="grade">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">活动简单介绍(50字内)</label>
						<div class="controls">
							<textarea class="span6 m-wrap" rows="4" name='short_intro'></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">联系人邮箱</label>
						<div class="controls">
							<input type="text" class="span6 m-wrap" name="email">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">联系人电话</label>
						<div class="controls">
							<input type="text" class="span6 m-wrap" name="telephone">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">活动起始日期</label>
						<div class="controls">
							<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" name='start' value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">活动结束日期</label>
						<div class="controls">
							<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" name='end'value="">
						</div>
					</div>
					<?php
					if ($user_type == '0') { ?>
					<div class="control-group">
						<label class="control-label">活动类型</label>
						<div class="controls">
							<label class="radio">
								<div class="radio"><span class="checked"><input type="radio" name="type" value="0" checked></span></div>
								正常不强制活动
							</label>
							<label class="radio">
								<div class="radio"><span><input type="radio" name="type" value="1"></span></div>
								强制型活动
							</label>
						</div>
					</div>
					<?php }
					?>
					<div class="control-group">
						<br>
						<span class="btn green fileinput-button">
							<span>添加附件...</span>
        					<input type="file" name='statement'>
        				</span>
					</div>
					<button type='submt' class='btn blue'>提交</button>
					<hr>
					<div class="alert alert-info">
						<p>您的请求将经过学院有关部门审核之后才有效</p>
						<p>请耐心等待，并检查您的收件箱</p>
						<p>谢谢!</p>
					</div>
				</form>
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

