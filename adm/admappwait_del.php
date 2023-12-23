<?php
$info = DB::fetch_table("sl8gdm_stuapply_del");
?>
<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>遞補作業系統</span>
	</p>
	<div class="inner-subtitle">
		<p>放棄名單檢視</p>
	</div>
	<div class="inner-content admappwait_del">
		<table class="inner-table" border=1>
			<tr>
				<th>申請編號</th>
				<th>放棄時間</th>
			</tr>
			<?php foreach ($info as $row) : ?>
				<tr>
					<td><?php echo $row["a_no"] ?></td>
					<td><?php echo substr($row["del_time"], 0, 16) ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<style>
		.admappwait_del {
			grid-template-columns: 50%;
		}

		.admappwait_del .inner-table {
			table-layout: auto;
		}
	</style>
</div>