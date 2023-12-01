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
      <?php
        $units=DB::fetch_table("sl8gdm_dep");
        foreach($units as $unit){
          // echo "{$unit['unit_head']} {$unit['unit_head_name']}<br>";
          echo"<tr><td>{$unit['unit_head']} {$unit['unit_head_name']}</td>
               <td>
                 <button type='submit' name='dep' value='{$unit['unit_head']}' class='action-button'>設定</button>
               </td></tr>";
        }
      ?>
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