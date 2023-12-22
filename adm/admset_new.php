<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<a href="/?inner=admset" class="link">期初設定</a>
		/
		<span>期初設定及期限設定</span>
	</p>
	<div class="inner-subtitle">
		<p>期初設定及期限設定</p>
	</div>

	<?php
	if (isset($_POST["add_time_set"])) {
		$added = $_POST["add_time_set"];
		$_SESSION["add_time_set"] = $added;
	} else if (isset($_POST["quota"]) && isset($_SESSION["add_time_set"])) {
		$added = $_SESSION["add_time_set"];

		if (isset($_POST["quota"])) {
			// var_dump($_POST);
			$year = $_POST["year_input"];
			$semester = $_POST["semester_input"];
			$dep_open = $_POST["dep_open_date"] . " " . $_POST["dep_open_time"] . ":00";
			$dep_close = $_POST["dep_close_date"] . " " . $_POST["dep_close_time"] . ":00";
			$stusl_open = $_POST["stusl_open_date"] . " " . $_POST["stusl_open_time"] . ":00";
			$stusl_close = $_POST["stusl_close_date"] . " " . $_POST["stusl_close_time"] . ":00";
			$time_set_values = [
				"apply_year" => $year,
				"dep_open" => $dep_open,
				"dep_close" => $dep_close,
				"stusl_open" => $stusl_open,
				"stusl_close" => $stusl_close,
			];
			DB::create_row("sl8gdm_time_limit", $time_set_values);
			header("location: /?inner=admset");
			exit;
		}
	} else if (isset($_POST["modify_time_set"])) {
		$year_key = $_POST["modify_time_set"];
		$time_set = [];
		$time_set = DB::fetchAll_rows("sl8gdm_time_limit", "apply_year", $year_key);

		$dep_open_date = substr($time_set[0]["dep_open"], 0, 10);
		$dep_close_date = substr($time_set[0]["dep_close"], 0, 10);
		$stusl_open_date = substr($time_set[0]["stusl_open"], 0, 10);
		$stusl_close_date = substr($time_set[0]["stusl_close"], 0, 10);
		$dep_open_time = substr($time_set[0]["dep_open"], 11, 15);
		$dep_close_time = substr($time_set[0]["dep_close"], 11, 15);
		$stusl_open_time = substr($time_set[0]["stusl_open"], 11, 15);
		$stusl_close_time = substr($time_set[0]["stusl_close"], 11, 15);
	} else {
		// fail to write into DB
		die();
	}
	?>
	<form class="inner-content admset_new" action="/?inner=admset_new" method="post">
		<div class="year_config">
			<label>學年度設定</label>
			<div>
				<label id="yearLabel">學年度: </label>
				<!-- ccu : 1989 -->
				<input type="number" name="year_input" required min="78" value="<?= $year_key ? $year_key : '' ?>">
			</div>
			<div>
				<label id="semesterLabel">學期: </label>
				<input type="number" name="semester_input" required min="1" max="2" value="<?= $year_key ? '1' : '' ?>">
			</div>

			<p>學年度請輸入三碼，學期請輸入一碼。</p>
			<p>(例: 98學年度請填098、上學期請填1)</p>
		</div>
		<div>
			<table class="inner-table" border="1">
				<tr>
					<td>項目</td>
					<td>期限開始</td>
					<td>期限結束</td>
				</tr>
				<tr>
					<td>1. 系所申請期限</td>
					<td>
						<div class="input-time">
							<label>設定日期</label>
							<input type="date" name="dep_open_date" required value="<?= $year_key ? $dep_open_date : '' ?>">
						</div>
						<div class="input-time">
							<label>設定時間</label>
							<input type="time" name="dep_open_time" required value="<?= $year_key ? $dep_open_time : '' ?>">
						</div>
					</td>
					<td>
						<div class="input-time">
							<label>設定日期</label>
							<input type="date" name="dep_close_date" required value="<?= $year_key ? $dep_close_date : '' ?>">
						</div>
						<div class="input-time">
							<label>設定時間</label>
							<input type="time" name="dep_close_time" required value="<?= $year_key ? $dep_close_time : '' ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>2. 遞補申請期限</td>
					<td>
						<div class="input-time">
							<label>設定日期</label>
							<input type="date" name="stusl_open_date" required value="<?= $year_key ? $stusl_open_date : '' ?>">
						</div>
						<div class="input-time">
							<label>設定時間</label>
							<input type="time" name="stusl_open_time" required value="<?= $year_key ? $stusl_open_time : '' ?>">
						</div>
					</td>
					<td>
						<div class="input-time">
							<label>設定日期</label>
							<input type="date" name="stusl_close_date" required value="<?= $year_key ? $stusl_close_date : '' ?>">
						</div>
						<div class="input-time">
							<label>設定時間</label>
							<input type="time" name="stusl_close_time" required value="<?= $year_key ? $stusl_close_time : '' ?>">
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="buttons">
			<button type="submit" class="action-button" name="quota">送出設定</button>
			<button type="reset" class="action-button">全部重設</button>
		</div>
	</form>
	<style>
		.admset_new .buttons {
			display: flex;
			padding: 2em;
			justify-content: center;
			width: 100%;
			gap: 1em;
		}

		.admset_new .action-button {
			padding: 0.4em;
			width: 30%;
		}

		.admset_new .year_config {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 1em;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		/* Label styling */
		.admset_new .year_config label {
			grid-column: 1 / -1;
			margin-bottom: 5px;
			font-weight: bold;
		}

		/* Input styling */
		.admset_new .year_config input {
			width: 100%;
			padding: 8px;
			margin-bottom: 10px;
			box-sizing: border-box;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
	</style>