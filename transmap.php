<?php
function map_nav($inner)
{
  $inner = "map_" . $inner;
  if ($_GET["inner"] !== $inner) {
    return "href=\"/?inner=$inner\"";
  } else {
    return "";
  }
}
?>

<div id="inner">
  <p id="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <?php
    if ($_GET["inner"] === "map") {
      echo "<span>宿舍區平面相對配置圖</span>";
    } else {
      echo "<a href=\"/?inner=map\" class=\"link\">宿舍區平面相對配置圖</a>/";
      echo "<span>" . strtoupper(substr($_GET["inner"], 4)) . " 棟宿舍配置</span>";
    }
    ?>
  </p>
  <div id="inner-subtitle">
    <p>宿舍區平面相對配置圖</p>
    <p>The Graduate Dorm Map</p>
  </div>
  <div id="inner-content">
    <p>如欲查詢各棟細部寢室配置圖，可從選單列表點選之。</p>
    <div>
      <?php
      echo "<a " . map_nav("a") . ">A棟宿舍配置</a>";
      echo "<a " . map_nav("b") . ">B棟宿舍配置</a>";
      echo "<a " . map_nav("c") . ">C棟宿舍配置</a>";
      echo "<a " . map_nav("d") . ">D棟宿舍配置</a>";
      echo "<a " . map_nav("e") . ">E棟宿舍配置</a>";
      ?>
    </div>
    <div>
      <?php

      switch (substr($_GET["inner"], 4)) {
        case "e":
          echo "<img src=\"pic/map_e1.gif\">";
          echo "<img src=\"pic/map_e23.gif\">";
          echo "<img src=\"pic/map_e4.gif\">";
          break;
        case false:
          // $_GET["inner"] === map
          echo "<img src=\"pic/map_all.gif\">";
          break;
        default:
          echo "<img src=\"pic/{$_GET["inner"]}12.gif\">";
          echo "<img src=\"pic/{$_GET["inner"]}34.gif\">";
          echo "<img src=\"pic/{$_GET["inner"]}5.gif\">";
          break;
      }
      ?>
    </div>
  </div>
</div>