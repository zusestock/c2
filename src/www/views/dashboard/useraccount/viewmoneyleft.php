<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<?php 
if (@$error) { ?>
	<div class="alert alert-warning"><?=$error?></div>
<?php } else if (@$left != NULL) { ?>
	<div class="alert alert-success">账户余额：<?=$left?></div>
<?php } ?>
<div class='row-fluid'>
	<div class="row-fluid">
	<div class="span12">
	<form action="/dashboard/viewmoneyleft" method='post'>
		<div class="control-group">
			<label class="control-label">资金账户</label>
			<div class="controls">
				<input type="input" class="span6 m-wrap" name="moneyaccount">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">取款密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="withdrawpass">
			</div>
		</div>
		<button type="submit" class='btn blue'>查询</button>
	</form>
	</div>
	</div>
</div>
<?php
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>