<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>期初設定</span>
	</p>
	<div class="inner-subtitle">
		<p>期初設定</p>
	</div>
	<?php
	// connect DB and fetch data here
	$time_set = DB::fetch_table("sl8gdm_time_limit");
	// var_dump($time_set); // print all value in table
	?>
	<div class="inner-content admset">
		<table class="inner-table" border="1">
			<tr>
				<td>學年度</td>
				<td>系所申請期限</td>
				<td>遞補申請期限</td>
				<td>操作</td>
			</tr>

			<?php foreach ($time_set as $row) : ?>
				<tr>
					<td><?= $row["apply_year"] ?></td>
					<td><?= substr($row["dep_open"], 0, 16) ?> 至 <?= substr($row["dep_close"], 0, 16) ?></td>
					<td><?= substr($row["stusl_open"], 0, 16) ?> 至 <?= substr($row["stusl_close"], 0, 16) ?></td>
					<td>
						<form action="/?inner=admset_new" method="post">
							<button class="action-button" type="submit" name="modify_time_set" value="<?= $row["apply_year"] ?>">修改</button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<form class="buttons" action="/?inner=admset_new" method="post">
			<button class="action-button" type="submit" name="add_time_set">新增</button>
		</form>
	</div>


	<style>
		.admset {
			grid-template-columns: 90%;
		}

		.admset .inner-table {
			table-layout: auto;
		}

		.admset .inner-table form {
			padding: 0 1em;
		}

		.admset .buttons {
			display: flex;
			padding: 2em;
			justify-content: center;
			width: 30%;
			gap: 1em;
		}

		.admset .action-button {
			padding: 0.4em;
			width: 100%;
		}
	</style>