<?php
function map_nav($inner)
{
  $inner = "map_" . $inner;
  if ($_GET["inner"] !== $inner) {
    return "href=\"/?inner=$inner\" class=\"link\"";
  } else {
    return "class=\"transmap-current\"";
  }
}
?>

<div class="inner">
  <p class="inner-nav">
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
  <div class="inner-subtitle">
    <p>宿舍區平面相對配置圖</p>
    <p>The Graduate Dorm Map</p>
  </div>
  <div class="inner-content transmap">
    <p>如欲查詢各棟細部寢室配置圖，可從選單列表點選之。</p>
    <div class="transmap-nav">
      <?php
      echo "<a " . map_nav("a") . ">A棟宿舍配置</a>";
      echo "<a " . map_nav("b") . ">B棟宿舍配置</a>";
      echo "<a " . map_nav("c") . ">C棟宿舍配置</a>";
      echo "<a " . map_nav("d") . ">D棟宿舍配置</a>";
      echo "<a " . map_nav("e") . ">E棟宿舍配置</a>";
      ?>
    </div>
    <div class="transmap-content">
      <?php
      switch (substr($_GET["inner"], 4)) {
        case "e":
          echo "<img src=\"pic/map_e01.gif\" class=\"inner-img\">";
          echo "<img src=\"pic/map_e23.gif\" class=\"inner-img\">";
          echo "<img src=\"pic/map_e4.gif\" class=\"inner-img\">";
          break;
        case false:
          // $_GET["inner"] === map
          echo "<img src=\"pic/map_all.gif\" class=\"inner-img\">";
          break;
        default:
          echo "<img src=\"pic/{$_GET["inner"]}12.gif\" class=\"inner-img\">";
          echo "<img src=\"pic/{$_GET["inner"]}34.gif\" class=\"inner-img\">";
          echo "<img src=\"pic/{$_GET["inner"]}5.gif\" class=\"inner-img\">";
          break;
      }
      ?>
    </div>
  </div>

  <style>
    .transmap {
      width: 100%;
    }

    .transmap-nav {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .transmap-nav > a {
      margin-inline: 1em;
    }

    .transmap-current {
      color: var(--primary-dark);
      font-weight: 600;
      height: 1.6em;
    }

    .transmap-content {
      display: grid;
      gap: 1em;
      width: 100%;
    }
  </style>
</div>