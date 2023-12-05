<?php
if(isset($_POST["del_target"])){
    // echo $_POST["del_target"];
    $target=DB::fetch_row("sl8gdm_dep_stuapply", "stu_cd", $_POST["del_target"]);
    $target_sex=$target["sex"];
    $target_unit=$target["unit_parent"];
    DB::delete_row("sl8gdm_dep_stuapply", ["stu_cd"=>$_POST["del_target"]]);
    if($target_sex == "M"){
        $row=DB::fetch_row("sl8gdm_dep", "unit_parent", $target_unit);
        $m_count=$row["m_count"];
        $m_count--;
        DB::update_row("sl8gdm_dep", ["unit_parent"=>$target_unit], ["m_count"=>$m_count]);
    }else{
        $row=DB::fetch_row("sl8gdm_dep", "unit_parent", $target_unit);
        $f_count=$row["f_count"];
        $f_count--;
        DB::update_row("sl8gdm_dep", ["unit_parent"=>$target_unit], ["f_count"=>$f_count]);
    }
    header("location:/?inner=admdelchk");
}
?>
<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>放棄確認</span>
  </p>
  <div class="inner-subtitle">
    <p>放棄申請列表</p>
  </div>
  <form class="inner-content admset_dep" action="/?inner=admdelchk" method="post">
    <table class="inner-table">
      <tr>
        <th>系所</th>
        <th>學號</th>
        <th>狀態</th>
        <th>操作</th>
      </tr>
      <?php
        $applylist=DB::fetch_table("sl8gdm_dep_stuapply");
        foreach($applylist as $element){
          $del_status="待確認";
          if($element["del_chk"] == "N"){
            continue;
          }
          echo"<tr>
            <td>{$element['unit_parent']}</td>
            <td>{$element['stu_cd']}</td>
            <td>{$del_status}</td>
            <td>
              <button type='submit' name='del_target' value='{$element['stu_cd']}' class='action-button' onclick='clicked(event)'>確認</button>
            </td></tr>";
        }
      ?>
    </table>
  </form>
  <script>
    function clicked(e)
    {
      if(!confirm("確認放棄?")) {
        e.preventDefault();
      }
    }
  </script>
  <style>
    .admset_dep{
      grid-template-columns: 1fr;
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