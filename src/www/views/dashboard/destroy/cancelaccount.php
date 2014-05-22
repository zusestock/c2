<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="row-fluid">
	<div class="span12">
	<?php
	if (@$success) { ?>
		<div class="alert alert-success">注销账户成功!</div>
	<?php }
	else if (@$error && count($error) > 0) { ?>
		<div class="alert alert-warning">
		<?php foreach ($error as $one_error) { ?>
			<p><?=$one_error?></p>
		<?php } ?>
		</div>
<?php	}
	?>
	<form action="/dashboard/cancelaccount" method='post'>
		<div class="control-group">
			<label class="control-label">身份证</label>
			<div class="controls">
				<input type="text" class="span6 m-wrap" name="nationalid">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">资金帐号</label>
			<div class="controls">
				<input type="text" class="span6 m-wrap" name="moneyaccount">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">交易密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="dealmoneypass">
			</div>
		</div>
		<button type="submit" class='btn blue'>提交</button>
	</form>

	</div>
	</div>
</div>
<?php
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>

