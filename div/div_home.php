<?php
$anns = DB::fetchAll_rows("sl8gdm_announce", "is_anno", "y", 6);

require_once "include/lib_sort_news.php";
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
      $sorted = sort_anns($anns);
      foreach ($sorted as $ann) {
        echo "<tr>";
        echo "<td style='text-align: start; padding-left: 8px;'><a href='/?inner=news&no=" . $ann["anno_no"] . "'>";
        echo $ann["is_top"] == "y" ? "[置頂] " : "";
        echo $ann["subject"] . "</td>";
        echo "<td>" . substr($ann["mod_time"], 0, 16) . "</a></td>";
        echo "</tr>";
      }
      ?>
    </table>
    <a href="/?inner=news" class="link">更多公告訊息</a>
  </div>

  <style>
    .div_home>.top {
      margin-top: 1em;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1em;
    }

    .div_home .left {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .div_home .left>.action-button {
      width: 80%;
      text-decoration: none;
      text-align: center;
    }

    .div_home .right {
      max-width: 100%;
    }

    .div_home>.news {
      table-layout: auto;
      max-width: 100%;
    }
  </style>
</div>