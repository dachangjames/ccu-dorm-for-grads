<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>住宿資格申請</span>
  </p>
  <div class="inner-subtitle">
    <p>住宿資格申請</p>
  </div>
  <div class="inner-content depapply">
    <?php
    $time_limit = DB::fetch_row("sl8gdm_time_limit", "apply_year", $year);
    $start = strtotime($time_limit["dep_open"]);
    $end = strtotime($time_limit["dep_close"]);
    $now = time();
    if ($start > $now || $end < $now) {
      echo "<h3>此功能不在開放期限內，故不開放作業！</h3>";
      echo "<p>申請期限：" . substr($time_limit["dep_open"], 0, 16) . " ~ " . substr($time_limit["dep_close"], 0, 16) . "</p>";
    } else {
      $unit = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $_SESSION["account"]["acc"]);
      $unit_parent = $unit["unit_parent"];
      $_SESSION["dep"] = $unit_parent;
      $dep = DB::fetch_row("sl8gdm_dep", "unit_parent", $unit_parent);
      $unit_name = $dep["unit_name"];
      $staff_name = $unit["staff_name"];
      $m_count = $dep["m_count"];
      $f_count = $dep["f_count"];
      $a_num_m = $dep["a_num_m"];
      $a_num_f = $dep["a_num_f"];
      echo "<h3>碩/博士生宿舍申請作業</h3>
            <table class='inner-table unit' border='1'>
              <tr>
                <th>申請單位</th>
                <td>$unit_parent $unit_name</td>
                <th>承辦人</th>
                <td>$staff_name</td>
              </tr>
              <tr>
                <th colspan='4'>已申請名額</th>
              </tr>
              <tr>
                <th>男</th>
                <td>$m_count</td>
                <th>女</th>
                <td>$f_count</td>
              </tr>
              <tr>
                <th colspan='4'>總名額限制</th>
              </tr>
              <tr>
                <th>男</th>
                <td>$a_num_m</td>
                <th>女</th>
                <td>$a_num_f</td>
              </tr>
            </table>";
      $stuapply = DB::fetchAll_rows("sl8gdm_dep_stuapply", "unit_parent", $unit_parent);
      if ($stuapply) {
        echo "<table class='inner-table apply' border='1'>
                <tr>
                  <th>申請編號</th>
                  <th>學號</th>
                  <th>性別</th>
                  <th>選寢方式</th>
                  <th>操作</th>
                </tr>";
        foreach ($stuapply as $apply) {
          if ($apply["choice_type"] === "s") {
            $choice = "自選寢室";
          } else if ($apply["choice_type"] === "m") {
            $choice = "管理員排定寢室";
          } else {
            $choice = "原寢室";
          }

          echo "<tr>
                  <td>" . $apply["a_no"] . "</td>
                  <td>" . $apply["stu_cd"] . "</td>
                  <td>" . ($apply["sex"] === "M" ? "男" : "女") . "</td>
                  <td>" . $choice . "</td>
                  <td>
                    <form action='/?inner=depapply_unit' method='POST'>
                      <input type='text' name='sid' value=" . $apply["stu_cd"] . " style='display: none'>
                      <button class='action-button' type='submit' name='op' value='update'>修改</button>
                    </form>
                  </td>
                </tr>";
        }
        echo "</table>";
      }

      echo "<form action='/?inner=depapply_unit' method='POST' class='buttons'>
              <button class='action-button' type='submit' name='op' value='add'>新增名單</button>
              <button class='action-button' type='button' onclick=\"window.location.href ='/output/output_depapp.php'\">輸出報表</button>
            </form>
            </div>";
    }
    ?>


    <style>
      .depapply {
        place-content: start;
        justify-content: center;
      }

      .depapply .unit {
        width: 70%;
      }

      .depapply .apply {
        table-layout: auto;
      }

      .depapply .buttons {
        display: flex;
        gap: 1em;
      }

      .depapply .action-button {
        padding: 0.6em 2em;
      }

      @media (width < 1200px) {
        .depapply .unit {
          width: 100%;
        }
      }
    </style>
  </div>