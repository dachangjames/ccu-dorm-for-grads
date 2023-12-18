<?php
$info = DB::fetch_table("sl8gdm_order");
$order_state = array(
    "Y" => "已取得住宿資格",
    "N" => "未取得住宿資格"
);
?>
<div class="inner">
    <p class="inner-nav">
		<a href="/" class="link">回首頁</a>
		/
		<span>遞補作業系統</span>
	</p>
	<div class="inner-subtitle">
		<p>抽籤名單檢視</p>
	</div>
    <div class="inner-content admappwait_numed">
		<table class="inner-table" border=1>
			<tr>
                <th>申請編號</th>
				<th>抽籤號碼</th>
                <th>抽籤結果</th>
			</tr>
        <?php foreach($info as $row){
            if($row["open_chk"] != false){
                echo "<tr><th>".$row["a_no"]."</th><th>".$row["order_no"]."</th><th>".$order_state[$row["open_chk"]]."</th><tr>";
            }
        }
        ?>
        </table>
    </div>
	<style>
		.admappwait_numed .inner-table{
			table-layout : auto;
		}
	</style>
</div>