<div class="inner">

    <!--  標題  -->
    <p class="inner-nav">
        <a href="/" class="link">回首頁</a>
        /
        <span>宿舍查詢系統</span>
    </p>

    <!--  副標題  -->
    <p class="inner-subtitle">
        排寢及選寢之結果查詢
    </p>

    <!--  內容  -->
    <p class="inner-mytable">
        <span>排寢、選寢結果查詢 - (<a href="?inner=admqry&option=1">依寢別</a>)</span>
        /
        <span>排寢、選寢結果查詢 - (<a href="?inner=admqry&option=2">依學號</a>)</span>
        /
        <span>排寢、選寢結果查詢 - (<a href="?inner=admqry&option=3">依系所</a>)</span>
    </p>

    <!--  動態修改頁面  -->
    <?php

    if (isset($_GET["inner"]) && $_GET["inner"] == "admqry" && isset($_GET["option"])) {
        $option_value = $_GET["option"];

        // 依寢別順序
        if ($option_value == 1) {
            echo '<p class=inner-mycontent>依照寢號別印出，若是沒有寢號則不會印出</p>';
            echo '<p class=inner-mycontent>Print out based on dormitory number, and if there is no dormitory number, it will not be printed.</p>';
            echo '<table class="inner-table">
                <tr>
                    <th>寢別</th>
                    <th>學號</th>
                    <th>系所</th>
                    <th>是否錄取</th>
                    <th>是否放棄</th>
                </tr>';

            $table = "sl8gdm_permit_rec";
            $rows = DB::fetch_table($table);

            $tableCheck = "sl8gdm_chrmlist";
            $rowsCheck = DB::fetch_table($tableCheck);

            function customSort($a, $b)
            {
                return strcmp($a['room_id'], $b['room_id']);
            }
            // 使用 usort 進行排序
            usort($rowsCheck, 'customSort');

            $tableSecondCheck = "sl8gdm_dep";
            $rowsSecondCheck = DB::fetch_table($tableSecondCheck);

            if (!empty($rowsCheck)) {
                foreach ($rowsCheck as $row1) {
                    // 寢別  有寢室才會印出來
                    $check = 0;
                    foreach ($rows as $row2) {
                        if ($row1['stu_cd'] == $row2['staff_cd']) {
                            echo '<tr>';
                            // 寢別
                            echo '<td>' . $row1['room_id'] . '</td>';
                            // 學號
                            echo '<td>' . $row2['staff_cd'] . '</td>';
                            // 系所
                            foreach ($rowsSecondCheck as $row3)
                                if ($row2['unit_parent'] == $row3['unit_parent'])
                                    echo '<td>' . $row3['unit_name'] . '</td>';
                            // 錄取和放棄與否
                            if ($row2['permit_cd'] == 'std' || $row2['permit_cd'] == 'stq') {
                                echo '<td>正取</td>';
                                echo '<td>放棄</td>';
                            } else if ($row2['permit_cd'] == 'spo' || $row2['permit_cd'] == 'stn' || $row2['permit_cd'] == 'sto' || $row2['permit_cd'] == 'swa') {
                                echo '<td>正取</td>';
                                echo '<td>未放棄</td>';
                            } else if ($row2['permit_cd'] == 'swd' || $row2['permit_cd'] == 'swo' || $row2['permit_cd'] == 'sww') {
                                echo '<td>等待候補</td>';
                                echo '<td>放棄</td>';
                            } else {
                                echo '<td>等待候補</td>';
                                echo '<td>未放棄</td>';
                            }
                            $check = 1;
                            break;
                        }
                    }
                    if (!$check)
                        echo '<td></td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        } // 依學號順序
        else if ($option_value == 2) {
            echo '<p class=inner-mycontent>依照學號別印出，若是沒有學號則不會印出</p>';
            echo '<p class=inner-mycontent>Print out based on student ID, and if there is no student ID, it will not be printed.</p>';
            echo '<table class="inner-table">
                <tr>
                    <th>學號</th>
                    <th>系所</th>
                    <th>寢別</th>
                    <th>是否錄取</th>
                    <th>是否放棄</th>
                </tr>';

            $table = "sl8gdm_permit_rec";
            $rows = DB::fetch_table($table);

            function customSort($a, $b)
            {
                return strcmp($a['staff_cd'], $b['staff_cd']);
            }
            // 使用 usort 進行排序
            usort($rows, 'customSort');

            $tableCheck = "sl8gdm_chrmlist";
            $rowsCheck = DB::fetch_table($tableCheck);

            $tableSecondCheck = "sl8gdm_dep";
            $rowsSecondCheck = DB::fetch_table($tableSecondCheck);

            if (!empty($rows)) {
                foreach ($rows as $row1) {
                    if (strtoupper(substr($row1['permit_cd'], 0, 1)) == 'S') {
                        echo '<tr>';
                        // 學號
                        echo '<td>' . $row1['staff_cd'] . '</td>';
                        // 系所
                        foreach ($rowsSecondCheck as $row2)
                        if ($row1['unit_parent'] == $row2['unit_parent'])
                            echo '<td>' . $row2['unit_name'] . '</td>';
                        // 寢別
                        $check = 0;
                        foreach ($rowsCheck as $row2) {
                            if ($row1['staff_cd'] == $row2['stu_cd']) {
                                echo '<td>' . $row2['room_id'] . '</td>';
                                $check = 1;
                                break;
                            }
                        }
                        if (!$check)
                            echo '<td>-</td>';
                        // 錄取和放棄與否
                        if ($row1['permit_cd'] == 'std' || $row1['permit_cd'] == 'stq') {
                            echo '<td>正取</td>';
                            echo '<td>放棄</td>';
                        } else if ($row1['permit_cd'] == 'spo' || $row1['permit_cd'] == 'stn' || $row1['permit_cd'] == 'sto' || $row1['permit_cd'] == 'swa') {
                            echo '<td>正取</td>';
                            echo '<td>未放棄</td>';
                        } else if ($row1['permit_cd'] == 'swd' || $row1['permit_cd'] == 'swo' || $row1['permit_cd'] == 'sww') {
                            echo '<td>等待候補</td>';
                            echo '<td>放棄</td>';
                        } else {
                            echo '<td>等待候補</td>';
                            echo '<td>未放棄</td>';
                        }
                        echo '</tr>';
                    }
                }
            }
            echo '</table>';
        } // 依系所順序
        else if ($option_value == 3) {
            echo '<p class=inner-mycontent>依照系所別印出，若是沒有系所則不會印出</p>';
            echo '<p class=inner-mycontent>Print out based on academic department, and if there is no academic department, it will not be printed.</p>';
            echo '<table class="inner-table">
                <tr>
                    <th>系所</th>
                    <th>學號</th>
                    <th>寢別</th>
                    <th>是否錄取</th>
                    <th>是否放棄</th>
                </tr>';

            $table = "sl8gdm_permit_rec";
            $rows = DB::fetch_table($table);

            function customSort($a, $b)
            {
                return strcmp($a['unit_parent'], $b['unit_parent']);
            }
            // 使用 usort 進行排序
            usort($rows, 'customSort');

            $tableCheck = "sl8gdm_chrmlist";
            $rowsCheck = DB::fetch_table($tableCheck);

            $tableSecondCheck = "sl8gdm_dep";
            $rowsSecondCheck = DB::fetch_table($tableSecondCheck);

            if (!empty($rows)) {
                foreach ($rows as $row1) {
                    if (strtoupper(substr($row1['permit_cd'], 0, 1)) == 'S') {
                        echo '<tr>';
                        // 系所
                        foreach ($rowsSecondCheck as $row2)
                        if ($row1['unit_parent'] == $row2['unit_parent'])
                            echo '<td>' . $row2['unit_name'] . '</td>';
                        // 學號
                        echo '<td>' . $row1['staff_cd'] . '</td>';
                        // 寢別
                        $check = 0;
                        foreach ($rowsCheck as $row2) {
                            if ($row1['staff_cd'] == $row2['stu_cd']) {
                                echo '<td>' . $row2['room_id'] . '</td>';
                                $check = 1;
                                break;
                            }
                        }
                        if (!$check)
                            echo '<td>-</td>';
                        // 錄取和放棄與否
                        if ($row1['permit_cd'] == 'std' || $row1['permit_cd'] == 'stq') {
                            echo '<td>正取</td>';
                            echo '<td>放棄</td>';
                        } else if ($row1['permit_cd'] == 'spo' || $row1['permit_cd'] == 'stn' || $row1['permit_cd'] == 'sto' || $row1['permit_cd'] == 'swa') {
                            echo '<td>正取</td>';
                            echo '<td>未放棄</td>';
                        } else if ($row1['permit_cd'] == 'swd' || $row1['permit_cd'] == 'swo' || $row1['permit_cd'] == 'sww') {
                            echo '<td>等待候補</td>';
                            echo '<td>放棄</td>';
                        } else {
                            echo '<td>等待候補</td>';
                            echo '<td>未放棄</td>';
                        }
                        echo '</tr>';
                    }
                }
            }
            echo '</table>';
        }
    }
    ?>

</div>

<style>
    .inner-mytable {
        display: flex;
        justify-content: center;
        gap: 1em;
    }

    .inner-mycontent {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1em;
        box-shadow: 2px 0 4px 2px rgba(0, 0, 0, 0.25);
    }
</style>
