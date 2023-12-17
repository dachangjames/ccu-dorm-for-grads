<?php
  if(isset($_POST["delete"])){
    $target_row=DB::fetch_row("sl8gdm_chrmlist", "stu_cd", $_POST["delete"]);
    DB::delete_row("a_no", ["a_no"=>$target_row["a_no"]]);
    $target_room_id=substr($target_row["room_id"], 0, 4);
    // echo $target_room;
    DB::delete_row("sl8gdm_chrmlist", ["stu_cd"=>$_POST["delete"]]);
    $target_room=DB::fetch_row("sl8gdm_room", "room_id", $target_room_id);
    $number=$target_room["room_p"];
    $remain=$target_room["room_remain"];
    $number--;
    $remain++;
    DB::update_row("sl8gdm_room", ["room_id"=>$target_room_id], ["room_p"=>$number]);
    DB::update_row("sl8gdm_room", ["room_id"=>$target_room_id], ["room_remain"=>$remain]);
    header("location:/?inner=stu_del");
  }
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>放棄住宿資格</span>
  </p>
  <div class="inner-subtitle">
    <p>放棄住宿資格</p>
  </div>

  <?php
    // var_dump($_SESSION);
    $account=$_SESSION["account"];
    $stu_id=$account["acc"];
    // echo $stu_id;
    $info=DB::fetch_row("sl8gdm_chrmlist", "stu_cd", $stu_id);
    if($info == false){
        echo "<div class='inner-content'>
                <h3>{$stu_id} 未持有住宿資格</h3>
                <a href='/?inner=stu_choice' class='link' style='font-size:22'>前往申請</a>
              </div>";
    }else{
        echo "<form class='inner-content stu_del' action='/?inner=stu_del' method='post'>
                <table class='inner-table'>
                  <tr>
                    <th>學號</th>
                    <th>房號</th>
                    <th>申請日期</th>
                  </tr>
                  <tr>
                    <td>{$info['stu_cd']}</td>
                    <td>{$info['room_id']}</td>
                    <td>{$info['cho_date']}</td>
                  </tr>
                  <tr>
                    <td colspan='3'>
                      <button type='submit' name='delete' value='{$info['stu_cd']}' class='action-button' onclick='clicked(event)'>放棄</button>
                    </td>
                  </tr>
                </table>
              </form>";
    }
  ?>
  <script>
    function clicked(e)
    {
      if(!confirm("確認放棄?")) {
        e.preventDefault();
      }
    }
  </script>
  <style>
    .stu_del {
        grid-template-columns: 50%;
    }

    .stu_del .action-button {
      padding: 0.4em;
    }
    
    .stu_del .inner-table {
      table-layout: auto;
    }
  </style>
</div>