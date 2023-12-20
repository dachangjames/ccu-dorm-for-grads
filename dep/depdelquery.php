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
        function unit2Char($unit) {         
            $unit_code = substr($unit, -2);
            $unit_code = trim($unit_code) . "000";   
            $query_set = DB::fetch_row("sl8gdm_dep","unit_parent", $unit_code);

            return $query_set["unit_name"];
        }
    
    ?>
    <div>
        <table class="inner-table" border="1">
                <tr>
                    <td>編號</td>
                    <td>放棄單位</td>
                    <td>放棄時間</td>
                </tr>
                <?php foreach ($del_table as $row) : ?>
				<tr>
					<td><?= $row["a_no"] ?></td>
                    <td><?= unit2Char($row["del_p"]) ?></td>
                    <td><?= substr($row["del_time"], 0, 16) ?></td>
				</tr>
			<?php endforeach; ?>

        </table>
    </div>
</div>