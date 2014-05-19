<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="row-fluid">
	<div class="span12">
	<?php
	if (@$state) { ?>
		<div class="alert alert-success">现在状态是：<?=$state?></div>
	<?php }
	if (@$error && count($error) > 0) { ?>
		<div class="alert alert-warning">
		<?php foreach ($error as $one_error) { ?>
			<p><?=$one_error?></p>
		<?php } ?>
		</div>
<?php	}
	?>
	<form action="/dashboard/<?=$method?>" method='post'>
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
			<label class="control-label">存取款密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="withdrawpass">
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

