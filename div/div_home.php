<?php
$anns = DB::fetchAll_rows("sl8gdm_announce", "is_anno", "y", 6);

function sort_top($anns) {
  $top = [];
  foreach ($anns as $ann) {
    if ($ann["is_top"] === "y") {
      $top[] = $ann;
    }
  }

  return $top + $anns;
}
?>

<div class="inner">
  <div class="inner-subtitle">
    <p>公告及登入系統</p>
    <p>Dorm Information</p>
  </div>
  <div class="inner-content div_home">
    <div class="top">
      <div class="left">
        <a href="/?inner=login" class="action-button">登入</a>
      </div>
      <div class="right">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quasi pariatur quam, praesentium voluptates enim odit incidunt similique dolor hic nemo molestias temporibus sapiente, neque eveniet dolore saepe molestiae ratione.</p>
      </div>
    </div>
    <table class="news inner-table" border="1">
      <tr>
        <th>公告主題</th>
        <th>公告日期</th>
      </tr>
      <?php
      $sorted = sort_top($anns);
      foreach ($sorted as $ann) {
        echo "<tr>";
        echo "<td style=\"text-align: start; padding-left: 8px;\"><a href=\"/?inner=news&no=" . $ann["anno_no"] . "\">";
        echo $ann["is_top"] == "y" ? "[置頂] " : "";
        echo $ann["subject"] . "</td>";
        echo "<td>" . substr($ann["anno_date"], 0, 16) . "</a></td>";
        echo "</tr>";
      }
      ?>
    </table>
    <a href="/?inner=news" class="link" >更多公告訊息</a>
  </div>

  <style>
    .div_home>.top {
      margin-top: 1em;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 1em;
    }

    .div_home>.top>.left {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .div_home>.top>.left>.action-button {
      width: 80%;
      text-decoration: none;
      text-align: center;
    }
    .div_home>.news {
      table-layout: auto;
    }
  </style>
</div>