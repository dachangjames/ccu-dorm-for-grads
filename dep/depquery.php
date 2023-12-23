<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>系所名額查詢</span>
	</p>
	<div class="inner-subtitle">
		<p>系所名額查詢</p>
	</div>
	<?php
		$unit = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $_SESSION["account"]["acc"]);
		$query_set = DB::fetch_row("sl8gdm_dep", "unit_parent", $unit["unit_parent"]);

		$unit_name = $query_set["unit_name"];
		$a_num_m = $query_set["a_num_m"];
		$a_num_f = $query_set["a_num_f"];
		$m_count = $query_set["m_count"];
		$f_count = $query_set["f_count"];
		// var_dump($unit_name);
	?>
	<div class="inner-content depquery">
		<div class="card">
			<div class="card-header">
				<h3 class="unit-name">查詢單位：<?php echo "$unit_name" ?></h3>
			</div>

			<div class="card-body">
				<div class="quota-item">
					<span class="label">申請名額上限(男)</span>
					<span class="value"><?= $a_num_m ?></span>
				</div>
				<div class="quota-item">
					<span class="label">申請名額上限(女)</span>
					<span class="value"><?= $a_num_f ?></span>
				</div>
				<div class="quota-item">
					<span class="label">已申請名額(男)</span>
					<span class="value"><?= $m_count ?></span>
				</div>
				<div class="quota-item">
					<span class="label">已申請名額(女)</span>
					<span class="value"><?= $f_count ?></span>
				</div>
			</div>
		</div>
	</div>


	<style>
		.depquery {
			grid-template-columns: 50%;
			gap: 1em;
		}

		.card {
			border: 1px solid #ddd;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			padding: 20px;
			width: 80%;
			/* 調整寬度，根據需要 */
			max-width: 400px;
			/* 設定最大寬度，如果有需要的話 */
		}

		.card-header {
			background-color: #f4f4f4;
			border-bottom: 1px solid #ddd;
			padding: 10px;
			text-align: center;
			border-radius: 8px;
		}

		.card-body {
			padding: 10px;
		}

		.quota-item {
			display: flex;
			justify-content: space-between;
			margin-bottom: 10px;
		}

		.label {
			font-weight: bold;
		}

		.value {
			color: #007bff;
			font-weight: bold;
		}
	</style>