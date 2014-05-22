<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<?php
if (@$post) {
	if (@$error) { ?>
		<div class="alert alert-warning"><?=$error?></div>
	<?php }
	else { ?>
		<div class="alert alert-success">修改成功, 重新登录</div>
		<script>
			setTimeout(function() {
				window.location.href="/login";
			}, 2000);
		</script>
	<?php }
}
?>
<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>修改密码</div>
			</div>
			<div class="portlet-body form">
				<form action="/dashboard/changepassword" method='post'>
					<div class="control-group">
						<label class="control-label">旧密码</label>
						<div class="controls">
							<input type="password" class="span6 m-wrap" name="passwdold">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">新密码</label>
						<div class="controls">
							<input type="password" class="span6 m-wrap" name="passwdnew">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">再次输入新密码</label>
						<div class="controls">
							<input type="password" class="span6 m-wrap" name="passwdnewagain">
						</div>
					</div>
					<button type="submit" class='btn blue'>提交</button>
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

