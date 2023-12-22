<?php
$acc = $_SESSION["account"];
$stu_id = $acc["acc"];
$info = DB::fetch_row("sl8gdm_chrmlist", "stu_cd", $stu_id);
$perm_info = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $stu_id);
$dep_info = DB::fetch_row("sl8gdm_dep", "unit_parent", $perm_info["unit_parent"]);
$apply_status = 0;
$status_info = "";
$apply_info = array(
	1 => "尚未取得住宿資格，請洽所辦或登記遞補",
	2 => "已選寢，寢室編號為 : "
);
if ($info == false) {
	$apply_status = 1;
} 
else {
	$apply_status = 2;
	$status_info = $info["room_id"];
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
			<tr>
                <td>系所</td>
                <td><?php echo $dep_info["unit_parent"]." ".$dep_info["unit_name"]; ?></td>
            </tr>
            <tr>
                <td>學號</td>
                <td><?php echo $stu_id; ?></td>
            </tr>
            <tr>
                <td>查詢結果顯示</td>
                <td><?php echo $apply_info[$apply_status]." ".$status_info; ?></td>
            </tr>
		</table>
	</div>

	<style>
		.stu_query .inner-table {
			table-layout: auto;
		}
	</style>
</div>