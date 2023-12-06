<?php
    if (isset($_POST["perm"])) {
      header("location:/?inner=admperm_unit");
    }

    $data=DB::fetch_table("sl8gdm_dep");

    $college=[];
    foreach($data as $row){
      $college[$row["unit_head_name"]][]=$row["unit_name"];
    }

    $deps =[];
    foreach ($data as $row) {
      $deps[$row["unit_parent"]] = $row["unit_name"];
    }
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>
      權限管理模組
    </span>
  </p>
  <div class="inner-subtitle">
    <p>權限管理模組</p>
  </div>

  <form class="inner-content admperm" action="/?inner=admperm_unit" method="post">

    <?php 
    foreach($college as $keys => $values) { //学院的table
      echo "<table class="."inner-table".">";
      echo "<tr>"."<th>".($keys)."</th>"."</tr> ";
      echo "<tr>";
      echo "<td>";
      $firstButton = true; // 用于判断是否是第一个按钮
  
      foreach($values as $value) { //每个学院table里的学系
          $dep = array_search($value, $deps);
          echo "<span style='margin:5px;'><button type='submit' name='perm' value='".$dep."' class='action-button'>".$value."</button></span>";
      }
      echo "</td>";
      echo "</tr>";
      echo "</table>";
    }
  
    ?>
  </form>

  <style>
    .admperm {
      width: 100%;
      place-self: start;
    }

    .admperm .action-button {
      /* padding-right: 0.7em; */
      width: 15%;
      height: 100px;
      vertical-align: top;
      margin-bottom: 10px;
    }

    .admperm .inner-table {
      width: 90%;
      /* table-layout: auto; */
    }
  </style>
<div>
