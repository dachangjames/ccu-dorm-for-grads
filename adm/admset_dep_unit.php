<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <a href="/?inner=admset_dep" class="link">系所申請住宿名額管理</a>
    /
    <span>系所申請名額設定</span>
  </p>
  <div class="inner-subtitle">
    <p>系所申請名額設定</p>
  </div>
  <?php
//   $deps = [
//     "1000" => "中國文學研究所",
//     "2000" => "數學研究所",
//     "3000" => "資訊工程研究所",
//     "4000" => "心理研究所",
//     "5000" => "法律研究所"
//   ];
  
  

  if (isset($_POST["dep"])) {
    $dep = $_POST["dep"];
    $_SESSION["dep"] = $dep;
    $data = DB::fetchAll_rows("sl8gdm_dep", "unit_head", $_POST["dep"]);
    $deps = [];
    foreach ($data as $row) {
      $deps[$row["unit_parent"]] = $row["unit_name"];    
    }
  } else if (isset($_POST["quota"]) && isset($_SESSION["dep"])) {
    $upd_Table = "sl8gdm_dep";
    $dep = $_SESSION["dep"];

    if (isset($_POST["quota"])) {
      unset($_POST["quota"]);
      foreach ($_POST as $unit_parent => $value) {
        $sex = substr($unit_parent, 4, 1);
        $unit = substr($unit_parent, 6);
        $upd_Row = array("unit_parent" => $unit);

        DB::update_row($upd_Table, $upd_Row, ["a_num_$sex" => $value]);
      }
      header("location: /?inner=admset_dep");
      exit;
    }
  } else {
    die();
  }
  ?>

  <form class="inner-content admset_dep_unit" action="/?inner=admset_dep_unit" method="post">
    <table class="inner-table" border="1">
      <tr>
        <th align="center">系所單位</th>
        <th align="center">男生名額</th>
        <th align="center">女生名額</th>
      </tr>
      <?php
      foreach ($deps as $head => $head_name) {
        echo "<tr><th align='center'>$head $head_name</th>";
        echo "<td align='center'>
                <div class='input-box'>
                  <input type='number' name='num_m_$head' required>
                  <label>男生名額</label>
                </div>
              </td>";
        echo "<td align='center'>
                <div class='input-box'>
                  <input type='number' name='num_f_$head' required>
                  <label>女生名額</label>
                </div>
              </td></tr>";
      }
      ?>
    </table>

    <div class="buttons">
      <button type="reset" class="action-button">Clear</button>
      <button type="submit" name="quota" class="action-button">Submit</button>
    </div>

    <style>
      .admset_dep_unit {
        place-self: start;
      }

      .admset_dep_unit .input-box {
        width: 80%;
      }

      .admset_dep_unit .input-box>input {
        width: 100%;
        height: 2em;
      }

      .admset_dep_unit .input-box>label {
        top: 8px;
        font-size: 0.8em;
      }

      .admset_dep_unit .buttons {
        display: flex;
        padding: 2em;
        justify-content: center;
        width: 100%;
        gap: 1em;
      }

      .admset_dep_unit .action-button {
        padding: 0.4em;
        width: 30%;
      }
    </style>
  </form>