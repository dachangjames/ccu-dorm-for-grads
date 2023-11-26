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
  $deps = [
    "1000" => "中國文學研究所",
    "2000" => "數學研究所",
    "3000" => "資訊工程研究所",
    "4000" => "心理研究所",
    "5000" => "法律研究所"
  ];

  if (isset($_POST["dep"])) {
    $dep = $_POST["dep"];
    $_SESSION["dep"] = $dep;
  } else if (isset($_POST["quota"]) && isset($_SESSION["dep"])) {
    $upd_Table = "sl8gdm_dep";
    $dep = $_SESSION["dep"];

    if (isset($_POST["quota"])) {
      var_dump($_POST);
      $num_m = $_POST["num_m_$dep"];
      $num_f = $_POST["num_f_$dep"];
      $upd_Row = array("unit_parent" => $dep);
      DB::update_row($upd_Table, $upd_Row, ["a_num_m" => $num_m]);
      DB::update_row($upd_Table, $upd_Row, ["a_num_f" => $num_f]);
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
        <th align="center" colspan="2">系所單位</th>
        <th align="center">男生名額</th>
        <th align="center">女生名額</th>
      </tr>
      <tr>
        <th align="center" rowspan="2" colspan="2"><?php echo $dep . " " . $deps[$dep] ?></td>
        <td align="center">
          <input type="number" name=<?php echo "num_m_$dep" ?> placeholder="0" required>
          <label>人</label>
        </td>
        <td align="center">
          <input type="number" name=<?php echo "num_f_$dep" ?> placeholder="0" required>
          <label>人</label>
        </td>
      </tr>
      <tr>
        <td align="center">
          <button type="submit" name="quota" class="action-button">Submit</button>
        </td>
        <td align="center">
          <button type="reset" class="action-button">Clear</button>
        </td>
      </tr>
    </table>

    <style>
      .admset_dep_unit {
        place-self: start;
      }

      .admset_dep_unit input {
        width: 70%;
      }

      .admset_dep_unit .action-button {
        padding: 0.4em;
        width: 80%;
      }
    </style>
  </form>