<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="row-fluid">
	<div class="span12">
	<?php
	if (@$error && count($error) > 0) { ?>
		<div class="alert alert-warning">
		<?php foreach ($error as $one_error) { ?>
			<p><?=$one_error?></p>
		<?php } ?>
		</div>
<?php } ?>
	<form action="/dashboard/addmoney" method='post'>
		<div class="control-group">
			<label class="control-label">资金账户</label>
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
		<div class="control-group">
			<label class="control-label">交易金额</label>
			<div class="controls">
				<input type="text" class="span6 m-wrap" name="withdrawmoney">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">交易类型</label>
			<div class="controls">
				<label class="radio">
				<div class="radio"><span class="checked"><input type="radio" name="dealtype" value="1" checked></span></div>
				存款
				</label>
				<label class="radio">
				<div class="radio"><span class=""><input type="radio" name="dealtype" value="0"></span></div>
				取款
				</label>
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

