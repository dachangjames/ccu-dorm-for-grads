<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>住宿資格申請(管理員)</span>
  </p>
  <div class="inner-subtitle">
    <p>住宿資格申請(管理員)</p>
  </div>

  <?php
  // 對資料庫sl8gdm_dep獲取所有的unit_name和對應的unit_parent
  $units = DB::fetch_table('sl8gdm_dep');

  // 生成下拉式清單的 HTML
  $selectHTML = '<select name="unit_name" id="unit_name">';
  foreach ($units as $unit) {
    $selectHTML .= '<option value="' . $unit['unit_parent'] . '">' . $unit['unit_name'] . '</option>';
  }
  $selectHTML .= '</select>';
  ?>

  <div class="inner-content admapply">
    <!-- 顯示表單 -->
    <form method="POST">
      請選擇您要查詢申請作業的單位：
      <?php echo $selectHTML; ?>
      <input type="submit" value="送出查詢">
    </form>
    <?php
    // 如果變數$unit_parent沒有值，中止執行。
    // 原理：先故意讓後面的php內容中止載入一次，當下拉式表單以POST方式傳送資料後，再重新載入一次即可。
    // 這樣就不必再搞一個php檔案了，且這樣的設計也可以避免每次用下拉式清單查詢後又要按回上一頁再選一次清單的狀況。
    if (!isset($_POST["unit_name"])) {
      die();
    }
    $unit_parent = $_POST["unit_name"];
    $dep = DB::fetch_row("sl8gdm_dep", "unit_parent", $unit_parent);
    $unit_name = $dep["unit_name"];
    // 依據表單選擇的單位，取得該單位的承辦人。
    // 注意：只會顯示第一個找到的承辦人，若有多個承辦人，則只會顯示第一個。畢竟版面也裝不下。
    $unit = DB::advanced_fetch_row("sl8gdm_permit_rec", "permit_cd", "dep", "unit_parent", $unit_parent);
    $staff_name = $unit["staff_name"];
    // 將變數$unit_parent的值存入session中，以便於admapply_unit.php使用。
    $unit_parent = $unit["unit_parent"];
    $_SESSION["adm"] = $unit_parent;

    $m_count = $dep["m_count"];
    $f_count = $dep["f_count"];
    $a_num_m = $dep["a_num_m"];
    $a_num_f = $dep["a_num_f"];
    echo "<h3>碩/博士生宿舍申請作業(管理員)</h3>
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
    $admapply = DB::fetchAll_rows("sl8gdm_dep_stuapply", "unit_parent", $unit_parent);
    if ($admapply) {
      echo "<table class='inner-table apply' border='1'>
                <tr>
                  <th>申請編號</th>
                  <th>學號</th>
                  <th>性別</th>
                  <th>選寢方式</th>
                  <th>操作</th>
                </tr>";
      foreach ($admapply as $apply) {
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
                    <form action='/?inner=admapply_unit' method='POST'>
                      <input type='text' name='sid' value=" . $apply["stu_cd"] . " style='display: none'>
                      <button class='action-button' type='submit' name='op' value='update'>修改</button>
                    </form>
                  </td>
                </tr>";
      }
      echo "</table>";
    }

    echo "<form action='/?inner=admapply_unit' method='POST' class='buttons'>
              <button class='action-button' type='submit' name='op' value='add'>新增名單</button>
              <button class='action-button' type='button' onclick=\"window.location.href ='/output/output_depapp.php'\">輸出報表</button>
            </form>
            </div>";
    ?>


    <style>
      .admapply .unit {
        width: 70%;
      }

      .admapply .apply {
        table-layout: auto;
      }

      .admapply .buttons {
        display: flex;
        gap: 1em;
      }

      .admapply .action-button {
        padding: 0.6em 2em;
      }

      @media (width < 1200px) {
        .admapply .unit {
          width: 100%;
        }
      }
    </style>
  </div>