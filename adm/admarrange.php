<div class="inner">
    <p class="inner-nav">
        <a href="/" class="link">回首頁</a>
        /
        <span>安排寢室設定</span>
    </p>
    <div class="inner-subtitle">
        <p>研究生宿舍 安排寢室設定</p>
</div>
<?php
    $arrange_set = [];
    $arrange_set = DB::fetchAll_rows("sl8gdm_chrmlist", "is_in", "n");
    // var_dump($arrange_set);
    function convertRoomNumber($roomNumber) {
        $lastTwoDigits = substr($roomNumber, 2);

        switch ($lastTwoDigits) {
            case '01':
                return $roomNumber . 'A';
            case '02':
                return $roomNumber . 'B';
            case '03':
                return $roomNumber . 'C';
            case '04':
                return $roomNumber . 'D';
            // Add more cases as needed
            default:
                return $roomNumber; // Default behavior if no match
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        foreach ($_POST as $key => $value) {
            $a_no = substr($key, 4);
            $cond = ["a_no" => $a_no];
            $values = ["is_in" => "y"];

            if (DB::update_row("sl8gdm_chrmlist", $cond, $values)) { 
                ;  
            } else {
                die();
            }
        }
    }
?>
<div class="inner-content admarrange">
    <table class="inner-table">
        <tr>
            <td>申請代號</td>
            <td>學號</td>
            <td>寢號</td>
            <td>修改為已入住</td>
        </tr>
        <?php foreach ($arrange_set as $row) : ?>
            <tr>
                <td><?= $row["a_no"] ?></td>
                <td><?= $row["stu_cd"] ?></td>
                <td><?= convertRoomNumber(substr($row["room_id"], 0, 4)) ?></td>
                <td>
                    <form action="/?inner=admarrange" method="post">
                        <button class="action-button buttons" type="submit" name="arr_<?= $row["a_no"] ?>" value="<?=$row["is_in"]?>">確認</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>

<style>
    .admarrange .buttons {
        padding: 10px;
    }
</style>

