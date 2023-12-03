<?php
    if (isset($_POST["perm"])) {
      header("location:/?inner=admperm_unit");
    }

    $college = [
      "文學院"=>array("中國文學研究所"),
      "理學院"=>array("數學研究所"),
      "社會科學院"=>array("心理研究所"),
      "工學院"=>array("資訊工程研究所"),
      "法學院"=>array("法律研究所")
    ];

    $deps = [
      "1000" => "中國文學研究所",
      //"1001"=>"歷史研究所",
      "2000" => "數學研究所",
      //"2001"=>"物理研究所",
      "3000" => "心理研究所",
      //"3001"=>"勞工研究所"
      "4000" => "資訊工程研究所",
      //"4001"=>"電機工程研究所",
      "5000" => "法律研究所",
      //"5001"=>"法學研究所"
    ];
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
    foreach($college as $keys => $values){ //學院的table
      echo "<table class="."inner-table".">";
      echo "<tr>"."<th>".($keys)."</th>"."</tr> ";
      echo "<tr>";
      foreach($values as $value){ //每個學院table裡的學系
        $dep=array_search($value,$deps);
        echo "<td>";
        echo "<button type="."submit"." name="."perm"." value=".$dep." class="."action-button".">".$value."</button>";
        echo "</td>";
      }
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
      padding: 0.7em;
      width: 13%;
    }

    .admperm .inner-table {
      table-layout: auto;
    }
  </style>
<div>
