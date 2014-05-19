<?php
include(VIEWPATH."dashboard/dashboard_header.php");
if (@$success) {
	echo "<div class='alert alert-success'>确认成功！</div>";
} else { ?>
<div class='row-fluid'>
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>补增参与人</div>
			</div>
			<div class="portlet-body form">
				<p class='alert alert-warning'>正在申请补增的人</p>
				<p class='alert alert-warning'>
				<?php if (@$already_bu && count($already_bu) > 0) {
					foreach ($already_bu as $bu) { ?>
						<span><?=$bu['username']?></span>
						<br>
				<?php }
				} else { ?>
					暂无
				<?php
				} ?>
				</p>
				<form action="/dashboard/uploadbu" method='post'>
					<textarea name="addbu" rows="10" class='form-control'></textarea>
					<div class="help-block">一行一个学号!</div>
					<input type="hidden" name='activity_id' value="<?=$activity_id?>">
					<p>
					<button type='submit' class='btn btn-success'>提交</button>
					</p>
				</form>
			</div>
		</div>
	</div>
</div>
<?php }
include(VIEWPATH."dashboard/include_js.php");
include(VIEWPATH."dashboard/root_footer.php");
?>