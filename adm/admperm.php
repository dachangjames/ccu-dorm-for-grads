<?php
if (isset($_POST["perm"])) {
  header("location:/?inner=admperm_unit");
}

$data = DB::fetch_table("sl8gdm_dep");

$college = [];
foreach ($data as $row) {
  $college[$row["unit_head_name"]][] = $row["unit_name"];
}

$deps = [];
foreach ($data as $row) {
  $deps[$row["unit_parent"]] = $row["unit_name"];
}
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>
      權限管理
    </span>
  </p>
  <div class="inner-subtitle">
    <p>權限管理</p>
  </div>

  <form class="inner-content admperm" action="/?inner=admperm_unit" method="post">

    <?php
    echo "<table class=" . "inner-table" . " border=\"1\" >";
    foreach ($college as $keys => $values) { //学院的table
      echo "<tr>" . "<th>" . ($keys) . "</th>";
      echo "<td>";
      $firstButton = true; // 用于判断是否是第一个按钮

      foreach ($values as $value) { //每个学院table里的学系
        $dep = array_search($value, $deps);
        echo "<button type='submit' name='perm' value='" . $dep . "' class='action-button'>" . $value . "</button>";
      }
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";

    ?>
  </form>

  <style>
    .admperm {
      grid-template-columns: 70%;
    }

    .admperm .action-button {
      padding: 0.4em;
      width: 50%;
    }

    .admperm .inner-table {
      table-layout: auto;
    }
  </style>
  <div>