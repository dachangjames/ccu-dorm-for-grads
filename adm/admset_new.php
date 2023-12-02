<div class="inner">
    <p class="inner-nav">
        <a href="/" class="link">回首頁</a>
        /
        <a href="/?inner=admset" class="link">期初設定</a>
        /
        <span>期初設定及期限設定資料寫入</span>
    </p>
    <div class="inner-subtitle">
        <p>研究生宿舍管理作業 期初設定及期限設定</p>
</div>

<?php
    if (isset($_POST["add_time_set"])) {
        $added = $_POST["add_time_set"];
        $_SESSION["add_time_set"] = $added;
    } else if (isset($_POST["quota"]) && isset($_SESSION["add_time_set"])) {
        $added = $_SESSION["add_time_set"];
        
        if (isset($_POST["quota"])){
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
    } else {
        echo "data failed";
        die();
    }
?>
<form class="inner-content" action="/?inner=admset_new" method="post">
        <div class="year_config">
            <label>學年度設定</label>
            <br>
            <label id="yearLabel">學年度: </label>
                                                    <!-- ccu : 1989 -->
            <input type="number" name="year_input" required min="78">
            <label id="semesterLabel">學期: </label>
            <input type="number" name="semester_input" required min="1" max="2">
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
                        <label>設定日期</label>     
                        <input type="date" name="dep_open_date" required>
                        <br>
                        <label>設定時間</label>
                        <input type="time" name="dep_open_time" required>
                    </td>
                    <td>
                        <label>設定日期</label>     
                        <input type="date" name="dep_close_date" required>
                        <br>
                        <label>設定時間</label>
                        <input type="time" name="dep_close_time" required>
                    </td>
                </tr>
                <tr>
                    <td>2. 遞補申請期限</td>
                    <td>              
                        <label>設定日期</label>     
                        <input type="date" name="stusl_open_date" required>
                        <br>
                        <label>設定時間</label>
                        <input type="time" name="stusl_open_time" required>
                    </td>
                    <td>
                        <label>設定日期</label>     
                        <input type="date" name="stusl_close_date" required>
                        <br>
                        <label>設定時間</label>
                        <input type="time" name="stusl_close_time" required>
                    </td>
                </tr>
            </table>
        </div>
        <div class="buttons">
            <button type="submit" class="action-button" name="quota">送出設定</button>
            <button type="reset" class="action-button" >全部重設</button>
        </div>
</form>
<style>
    .buttons {
        display: flex;
        padding: 2em;
        justify-content: center;
        width: 100%;
        gap: 1em;
    }
    .action-button {
        padding: 0.4em;
        width: 30%;
      }
    .year_config {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    /* Label styling */
    .year_config label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    /* Input styling */
    .year_config input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>