<?php
if (isset($_POST["perm"])) {
  $data = DB::fetch_table("sl8gdm_dep");
  $deps = [];
  foreach ($data as $row) {
    $deps[$row["unit_parent"]] = $row["unit_name"];
  }

  $perm = $_POST["perm"];

  $watch_Table = "sl8gdm_permit_rec";
  $search_col = "unit_parent";
  $row = DB::fetchALL_rows($watch_Table, $search_col, $perm, 100);
} else if (isset($_POST["quota"]) && isset($_SESSION["perm"])) {
  $upd_Table = "sl8gdm_permit_rec";
  $perm = $_POST["quota"];

  if (isset($_POST["quota"])) { //按送出鍵

    if (isset($_POST['deletion']) && is_array($_POST['deletion'])) { //刪除權限
      foreach ($_POST["deletion"] as $id) {
        DB::delete_row($upd_Table, ["staff_cd" => $id]);
      }
    }

    if (isset($_POST['column1']) && isset($_POST['column2'])) { //新增權限
      $staff_data = array_combine($_POST['column1'], $_POST['column2']);
      foreach ($staff_data as $cd => $name) {

        $data = [
          "staff_cd" => $cd,
          "unit_parent" => $perm,
          "permit_cd" => substr($cd, 0, 3),
          "staff_name" => $name,
          "pw" => hash('SHA256', substr($cd, 0, 3))
        ];
        DB::create_row($upd_Table, $data);
      }
    }

    header("location: /?inner=admperm");
    exit;
  }
} else {
  die();
}
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <a href="/?inner=admperm" class="link">權限管理</a>
    /
    <span>權限管理模組</span>
  </p>
  <div class="inner-subtitle">
    <p>權限管理模組</p>
  </div>

  <div>

    <form class="inner-content admperm_unit" action="/?inner=admperm_unit" method="post">

      <table class="inner-table" border="1" id="permTable">
        <tr>
          <th>使用者代號</th>
          <th>使用者姓名</th>
          <th>所屬單位</th>
          <th>單位代號</th>
          <th>刪除權限</th>
        </tr>

        <?php
        $cnt = 0;
        foreach ($row as $staff) { //權限table
          if (substr($staff["staff_cd"], 0, 3) === "dep" || substr($staff["staff_cd"], 0, 3) === "adm") {
            echo "<tr>";
            echo "<td>" . $staff["staff_cd"] . "</td>";
            echo "<td>" . $staff["staff_name"] . "</td>";
            echo "<td>" . $deps[$perm] . "</td>";
            echo "<td>" . $perm . "</td>";
            echo "<td><input type='checkbox' name='deletion[]' value='" . $staff["staff_cd"] . "'></td>";
          }
        }
        ?>
      </table>

      <div class="button-part">
        <button type="submit" name="quota" value="<?php echo $perm ?>" class="action-button">送出</button>
        <button type="reset" class="action-button">重新設定</button>
        <button type="button" class="action-button" onclick="addRow()">新增教職員</button>
      </div>

      <style>
        .admperm_unit {
          place-self: start;
        }

        .admperm_unit .inner_table {
          table-layout: auto;
        }

        .admperm_unit input {
          width: 100%;
        }

        .admperm_unit .action-button {
          max-width: 100%;
          width: 120px;
          padding: 0.4em;
        }

        .admperm_unit .button-part {
          width: 100%;
          display: flex;
          justify-content: center;
          gap: 1em;
        }

        .admperm_unit .input-box2 {
          border-radius: 5px;
          border: 2px solid var(--primary-dark);
        }

        .admperm_unit ::placeholder {
          text-align: center;
          color: var(--primary-dark);
        }
      </style>
    </form>

    <script>
      var cnt = <?php echo $cnt; ?>;

      function addRow() { // 往權限table的下方，新增一列
        var table = document.getElementById("permTable");
        var row = table.insertRow(-1);

        // 創建第一個單元格並設置為 <th>
        // var cell0 = document.createElement("th");
        // cell0.innerHTML = cnt += 1;
        // cell0.setAttribute("scope", "row"); // 添加 scope 屬性，表示這是行的標頭
        // row.appendChild(cell0);

        // 從第二個單元格開始，創建 <td> 元素
        for (var i = 0; i < 5; i++) {
          var cell = row.insertCell(i);

          // Add input fields to each cell
          switch (i) {
            case 0:
              cell.innerHTML = '<input type="text" name="column1[]" class="input-box2" pattern="^(dep)\\d{7}$" placeholder="dep+7位數字" required title="輸入錯誤，請以dep開頭，後跟7位數字">';
              break;
            case 1:
              cell.innerHTML = '<input type="text" name="column2[]" class="input-box2" required>';
              break;
            case 2:
              cell.innerHTML = '<?php echo $deps[$perm] ?>';
              break;
            case 3:
              cell.innerHTML = '<?php echo $perm ?>';
              break;
            case 4:
              cell.innerHTML = '<button type="button" class="action-button" style="font-size: 0.7em;" onclick="deleteRow(this)">刪除新增列</button>';
              break;
          }
        }
      }

      function deleteRow(button) { //刪除新增列
        var table = document.getElementById("permTable");
        var row = button.parentNode.parentNode;
        var rowIndex = row.rowIndex;
        var temp
        table.deleteRow(rowIndex);
        cnt--;

        // 遞減第 m+1 行以下的 cell
        for (var i = rowIndex; i < table.rows.length; i++) {
          temp = table.rows[i].cells[0].innerHTML;
          temp--;
          table.rows[i].cells[0].innerHTML = temp;
        }
      }
    </script>
</div>