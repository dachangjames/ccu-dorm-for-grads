<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>確認放棄查詢</span>
	</p>
	<div class="inner-subtitle">
		<p>確認放棄查詢</p>
	</div>
	<?php
	$del_table = DB::fetch_table("sl8gdm_stuapply_del");
	$staff_cd = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $_SESSION["account"]["acc"]);
	$delapply = [];
	foreach ($del_table as $row) {
		if (substr($row["a_no"], 3, 4) === $staff_cd["unit_parent"]) {
			$delapply[] = $row;
		}
	}
	?>
	<div>
		<table class="inner-table" border="1">
			<tr>
				<td>編號</td>
				<td>放棄單位</td>
				<td>放棄時間</td>
			</tr>
			<?php foreach ($delapply as $row) : ?>
				<?php $del_p = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $row["del_p"]) ?>
				<tr>
					<td><?= $row["a_no"] ?></td>
					<td><?= $del_p["unit_parent"] ?></td>
					<td><?= substr($row["del_time"], 0, 16) ?></td>
				</tr>
			<?php endforeach; ?>

		</table>
	</div>
</div>