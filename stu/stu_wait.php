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

    if($info){
      echo "<div class='inner-content stu_wait'>";
      echo "<h1>你已經申請遞補</h1>";
      echo "<a href='/?inner=stu_choice' class='link' style='font-size:22'>修改床位</a>";
      echo  "</div>";
    }else{
      echo "<div class='inner-content stu_wait'>";
      echo "<h1>你還未申請遞補</h1>";
      echo "<a href='/?inner=stu_choice' class='link' style='font-size:22'>選擇床位</a>";
      echo  "</div>";
    }

  ?>
</div>