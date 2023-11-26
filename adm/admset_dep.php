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
  <form action="/?inner=admset_dep_unit" method="post">
    <table class="inner-table">
      <tr style="font-weight: bold;">
        <td align="center">#</td>
        <td align="center">學院</td>
        <td align="center">操作</td>
      </tr>
      <tr>
        <td align="center">1</td>
        <td align="center">1000 文學院</td>
        <td align="center">
          <button type="submit" name="dep" value="1000">設定</button>
        </td>
      </tr>
      <tr>
        <td align="center">2</td>
        <td align="center">2000 理學院</td>
        <td align="center">
          <button type="submit" name="dep" value="2000">設定</button>
        </td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td align="center">3000 工學院</td>
        <td align="center">
          <button type="submit" name="dep" value="3000">設定</button>
        </td>
      </tr>
      <tr>
        <td align="center">4</td>
        <td align="center">4000 社會科學院</td>
        <td align="center">
          <button type="submit" name="dep" value="4000">設定</button>
        </td>
      </tr>
      <tr>
        <td align="center">5</td>
        <td align="center">5000 法學院</td>
        <td align="center">
          <button type="submit" name="dep" value="5000">設定</button>
        </td>
      </tr>
    </table>
  </form>
</div>