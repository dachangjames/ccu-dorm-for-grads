<?php
if (isset($_POST["dep"])) {
  header("location:/?inner=admset_dep_unit");
}
?>
<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>系所申請住宿名額管理</span>
  </p>
  <div class="inner-subtitle">
    <p>系所申請住宿名額管理</p>
  </div>
  <form class="inner-content admset_dep" action="/?inner=admset_dep_unit" method="post">
    <table class="inner-table">
      <tr>
        <th>學院</th>
        <th>操作</th>
      </tr>
      <tr>
        <td>1000 文學院</td>
        <td>
          <button type="submit" name="dep" value="1000">設定</button>
        </td>
      </tr>
      <tr>
        <td>2000 理學院</td>
        <td>
          <button type="submit" name="dep" value="2000">設定</button>
        </td>
      </tr>
      <tr>
        <td>3000 工學院</td>
        <td>
          <button type="submit" name="dep" value="3000">設定</button>
        </td>
      </tr>
      <tr>
        <td>4000 社會科學院</td>
        <td>
          <button type="submit" name="dep" value="4000">設定</button>
        </td>
      </tr>
      <tr>
        <td>5000 法學院</td>
        <td>
          <button type="submit" name="dep" value="5000" class="action-button">設定</button>
        </td>
      </tr>
    </table>
  </form>

  <style>
    .admset_dep {
      width: 100%;
      place-self: start;
    }

    .admset_dep .action-button {
      padding: 0.4em;
      width: 40%;
    }

    .admset_dep .inner-table {
      table-layout: auto;
    }
  </style>
</div>