<?php
$info = DB::fetch_table("sl8gdm_order");
$orders = array();
foreach ($info as $row) {
	if ($row["open_chk"] === "N") {
		array_push($orders, array(
			0 => $row["order_no"],
			1 => $row["a_no"]
		));
	}
}
?>
<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>遞補作業系統</span>
	</p>
	<div class="inner-subtitle">
		<p>抽籤功能操作</p>
	</div>
	<div class="inner-content admappwait_num">
		<?php if (!isset($_POST["draw"])): ?>
			<form method="POST">
				<div class="input-box">
					<input type="text" name="draw" required>
					<label>抽籤人數</label>
				</div>
				<button type="submit" class="action-button" onclick="click_start(event)">開始抽籤</button>
			</form>
		<?php endif ?>
		<?php
		if (isset($_POST["draw"])) {
			if (!empty($orders)) {
				$n = intval($_POST["draw"]);
				$selected = array();
				for ($i = 0; $i < $n; $i++) {
					$idx = array_rand($orders);
					$tmp = $orders[$idx];
					unset($orders[$idx]);
					$orders = array_values($orders);
					array_push($selected, $tmp);
				}
				echo '
                    <h3>抽籤結果顯示</h3>
		            <table class="inner-table" border=1>';
				echo '      <tr>
                            <th>抽籤號碼</th>
                            <th>申請編號</th>
                        </tr>';
				foreach ($selected as $row) {
					echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td></tr>';
					DB::update_row("sl8gdm_order", ["order_no" => $row[0]], ["open_chk" => "Y"]);
				}
				echo '</table>';
				foreach ($orders as $row) {
					DB::update_row("sl8gdm_order", ["order_no" => $row[0]], ["open_chk" => "N"]);
				}
			}
		}
		?>
	</div>

	<script>
		function click_start(c) {
			if (!confirm("開始抽籤?(抽籤結果將被寫入到資料庫)")) {
				c.preventDefault();
			}
		}
	</script>
	<style>
		.admappwait_num {
			grid-template-columns: 50%;
		}

		.admappwait_num form {
			display: flex;
			flex-direction: column;
			gap: 1em;
		  align-items: center;
		}

		.admappwait_num .action-button {
			width: 200px;
		}

		.admappwait_num .inner-table {
			width: 100%;
			table-layout: auto;
		}
	</style>
</div>