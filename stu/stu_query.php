<?php
$acc = $_SESSION["account"];
$stu_id = $acc["acc"];
$info = DB::fetch_row("sl8gdm_dep_stuapply", "stu_cd", $stu_id);
$stu_dep = ""; //department, only visible under status 2-6
$stu_dep_name = "";
$apply_status = 0;
/* Apply status:
1 : Not qualified (need to apply)
2 : Qualified (need to choose room)
3 : Choosed room with room number xxx
4 : Stay in original room with number xxx
5 : Waiting to fill vancancies with number xxx
6 : Gived up qualification
*/
$status_info = ""; // room number / order number
$apply_info = array(
	1 => "尚未取得住宿資格，請洽所辦或登記遞補",
	2 => "已取得住宿資格，尚未選寢",
	3 => "已選寢，寢室編號為 : ",
	4 => "續住原寢室，寢室編號為 : ",
	5 => "已登記遞補，遞補籤號為 : ",
	6 => "已放棄住宿資格"
);
if ($info == false) {
	$apply_status = 1;
} else {
	$stu_dep = $info["unit_parent"];
	$unit_parent = DB::fetch_row("sl8gdm_dep", "unit_parent", $stu_dep);
	$stu_dep_name = $unit_parent["unit_name"];
	if ($info["del_chk"] == "G") {
		$apply_status = 6;
	} else if ($info["org_room"] == "") {
		$apply_status = 2;
	} else if (DB::fetch_row("sl8gdm_order", "a_no", $info["a_no"])) {
		$order = DB::fetch_row("sl8gdm_order", "a_no", $info["a_no"]);
		$apply_status = 5;
		if ($order["open_chk"] == "Y") {
			$status_info = $order["order_no"] . " (已取得住宿資格)";
		} else {
			$status_info = $order["order_no"] . " (尚未取得住宿資格，請等待遞補作業)";
		}
	} else {
		if ($info["choice_type"] == "o") {
			$apply_status = 4;
			$status_info = $info["org_room"];
		} else {
			$apply_status = 3;
			$chrm = DB::fetch_row("sl8gdm_chrmlist", "stu_cd", $stu_id);
			if ($chrm == false) {
				$status_info = "查無寢號";
			} else {
				$status_info = $chrm["room_id"];
			}
		}
	}
}
?>
<div class="inner">
	<p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>申請狀態查詢系統</span>
	</p>
	<div class="inner-subtitle">
		<p>申請狀態查詢系統</p>
	</div>
	<div class="inner-content stu_query">
		<table class="inner-table" border="1">
			<?php
			if ($apply_status == 1) {
				echo "<tr>
                    <th>學號</th>
                    <th>{$stu_id}</th>
                 </tr>
                 <tr>
                    <td>查詢結果顯示</td>
                    <td>{$apply_info[$apply_status]}</td>
                 </tr>";
			} else {
				echo "<tr>
                    <td>系所</td>
                    <td>{$stu_dep} {$stu_dep_name}</td>
                  </tr>
                  <tr>
                    <td>學號</td>
                    <td>{$stu_id}</td>
                  </tr>
                  <tr>
                    <td>查詢結果顯示</td>
                    <td>{$apply_info[$apply_status]} {$status_info}</td>
                  </tr>";
			}
			?>
		</table>
	</div>

	<style>
		.stu_query .inner-table {
			table-layout: auto;
		}
	</style>
</div>