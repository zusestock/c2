<?php
include(VIEWPATH."dashboard/dashboard_header.php");
?>
<div class='row-fluid'>
	<div class="row-fluid">
	<div class="span12">
	<?php
	if (@$state) { ?>
		<div class="alert alert-success">成功重新开户，请输入密码</div>
	<?php }
	if (@$account && $account == -1) { ?>
		<div class="alert alert-warning">添加密码失败,请重新进行整个流程</div>
	<?php } else if (@$account) { ?>
		<div class="alert alert-success">恭喜您，添加资金账户成功，您的账户是<?=$account?></div>
	<?php } else {
	if (@$error && count($error) > 0) { ?>
		<div class="alert alert-warning">
		<?php foreach ($error as $one_error) { ?>
			<p><?=$one_error?></p>
		<?php } ?>
		</div>
	<?php }
	if (@$inputpassword) { ?>
	<form action="/dashboard/newaccount/updatepassword" method='post'>
		<div class="control-group">
			<label class="control-label">交易密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="dealpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">再次输入交易密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="dealpassagain">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">取款密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="withdrawpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">再次输入取款密码</label>
			<div class="controls">
				<input type="password" class="span6 m-wrap" name="withdrawpassagain">
			</div>
		</div>
		<input type="hidden" name="stockaccount" value="<?=$stockaccount?>">
		<input type="hidden" name="nationalid" value="<?=$nationalid?>">
		<button type="submit" class='btn blue'>提交密码</button>
	</form>
	<?php } else { ?>
	<form action="/dashboard/newaccount/checkvalid" method='post'>
		<div class="control-group">
			<label class="control-label">身份证</label>
			<div class="controls">
				<input type="text" class="span6 m-wrap" name="nationalid">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">证券帐号</label>
			<div class="controls">
				<input type="text" class="span6 m-wrap" name="stockaccount">
			</div>
		</div>
		<button type="submit" class='btn blue'>检查</button>
	</form>
	<?php }
	} ?>

	</div>
	</div>
</div>
<?php
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>

