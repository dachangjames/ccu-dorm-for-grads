<?php

    $data = DB::fetch_table("sl8gdm_permit");
    $stu_perm=[];

    foreach($data as $row){
        if(substr($row["permit_cd"],0,1)==="s"){
            $stu_perm[]=$row["permit_cd"];
        }
    }

?>


<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>遞補申請</span>
  </p>
  <div class="inner-subtitle">
    <p>遞補申請</p>
  </div>

  <?php
    $account=$_SESSION["account"];
    $stu_id=$account["acc"];
    $info=DB::fetch_row("sl8gdm_chrmlist", "stu_cd", $stu_id);

    $currentDateTime = date("Y-m-d H:i:s");
    $ROC_year=substr($currentDateTime,0,4)-1911;
    $valid_date=DB::fetch_row("sl8gdm_time_limit", "apply_year", $ROC_year);

    if(strtotime($currentDateTime)<strtotime($valid_date["stusl_open"])||strtotime($currentDateTime)>strtotime($valid_date["stusl_close"])){
        echo "<h1>遞補申請還未開放</h1>";
    }else{
        if($info===0){
          echo "<div class='inner-content'>";
          echo "<h3>你已經申請遞補</h3>";
          echo "<a href='/?inner=stu_choice' class='link' style='font-size:22'>修改床位</a>";
          echo  "</div>";
        }else{
          echo "<div class='inner-content'>";
          echo "<h3>你還未申請遞補了</h3>";
          echo "<a href='/?inner=stu_choice' class='link' style='font-size:22'>選擇床位</a>";
          echo  "</div>";
        }
    }

  ?>
  <style>
    .stu_wait {
        grid-template-columns: 50%;
    }

    .stu_wait .action-button {
      padding: 0.4em;
    }
    
    .stu_wait .inner-table {
      table-layout: auto;
    }
  </style>
</div>

