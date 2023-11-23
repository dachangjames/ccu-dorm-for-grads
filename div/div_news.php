<?php
require_once "include/lib_sort_news.php";

$showAll = true;
if (isset($_GET["no"])) {
  $anno = DB::fetch_row("sl8gdm_announce", "anno_no", $_GET["no"]);
  $showAll = !$anno;
} else {
  $anns = DB::fetchAll_rows("sl8gdm_announce", "is_anno", "y");
  $sorted = sort_anns($anns);
  $news_count = count($anns);
}
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>重要公告</span>
  </p>
  <div class="inner-subtitle">
    <p>重要公告</p>
    <p>Important News For The Dormitory</p>
  </div>
  <!-- all news -->
  <div class="inner-content div_news <?php echo $showAll ? "" : "hide"; ?>">
    <div class="news_head">
      <div class="news_count_select">
        <span>每頁</span>
        <select id="newsPerPage_select">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
        <span>筆</span>
      </div>
      <div class="news_nav">
        <i class="bx bx-chevrons-left" id="firstPage"></i>
        <i class="bx bx-chevron-left" id="prevPage"></i>
        <span id="pageNav"></span>
        <i class="bx bx-chevron-right" id="nextPage"></i>
        <i class="bx bx-chevrons-right" id="lastPage"></i>
      </div>
    </div>
    <table border="1" class="inner-table">
      <tr>
        <th>公告主題</th>
        <th>公告日期</th>
      </tr>
      <?php
      if ($showAll) {
        for ($i = 0; $i < $news_count; $i++) {
          echo "<tr class='news'>";
          echo "<td style='text-align: start; padding-left: 8px;'><a href='/?inner=news&no=" . $sorted[$i]["anno_no"] . "'>";
          echo $sorted[$i]["is_top"] == "y" ? "[置頂] " : "";
          echo $sorted[$i]["subject"] . "</td>";
          echo "<td>" . substr($sorted[$i]["anno_date"], 0, 16) . "</a></td>";
          echo "</tr>";
        }
      }
      ?>
    </table>
  </div>

  <!-- individuals -->
  <div class="inner-content div_news <?php echo $showAll ? "hide" : ""; ?>">
    <?php
    if (!$showAll) {
      echo "<h1>" . $anno["subject"] . "</h1>";
      echo "<p>" . $anno["note"] . "</p>";
    }
    ?>
  </div>

  <style>
    .div_news {
      place-self: start;
      width: 100%;
    }

    .div_news>.news_head {
      display: flex;
      width: 100%;
      gap: 1em;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
    }

    .div_news .news_count_select {
      display: flex;
      gap: 0.4em;
      margin-right: auto;
    }

    .div_news .news_count_select>select {
      width: 69px;
    }

    .div_news .news_nav {
      display: flex;
      align-items: center;
      gap: 1em;
    }

    .div_news .bx {
      font-size: 1.2em;
      width: 1em;
      height: 1em;
      place-items: center;
      background-color: var(--primary-light);
      border-radius: 50%;
      cursor: pointer;
    }

    .div_news .bx:hover {
      background-color: var(--primary-light-active);
    }

    .div_news>.inner-table {
      grid-column: 1 / -1;
    }

    .div_news>.inner-table tr {
      display: grid;
      grid-template-columns: 1fr 30%;
    }

    .div_news.hide {
      display: none;
    }

    .div_news>h1 {
      place-self: start;
    }

    .div_news>p {
      line-height: 2;
    }
  </style>
  <script src="js/newsPageChange.js"></script>
</div>