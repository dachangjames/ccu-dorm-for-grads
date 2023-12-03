<?php
$sex = $_SESSION["account"]["sex"];
$sid = $_SESSION["account"]["acc"];
$building = '';
$floor = '';
const BUILDINGS = ["1" => "A", "2" => "B", "3" => "C", "4" => "D", "5" => "E"];
if (isset($_POST["select"])) {
  $building = $_POST["select"][0];
  $floor = $_POST["select"][1];
  $rooms = DB::fetchAll_rows("sl8gdm_room", "room_sex", $sex);
  $selected = array_filter($rooms, function ($room) {
    return substr($room["room_id"], 0, 2) === $_POST["select"];
  });
  $chrmlist = DB::fetch_table("sl8gdm_chrmlist");
  foreach ($chrmlist as $chrm) {
    $id_list[] = $chrm["room_id"];
  }
} else if (isset($_POST["selected_room"])) {
  echo "<script>
          if (!confirm('確定選擇此床位？')) {
            alert('操作取消')
            location.href = '/?inner=stu_choice'
          }
        </script>";
  
  $a_nos = DB::fetchAll_rows("a_no", "ty_pe", "chrmlist");
  $user = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $sid);
  $dep = $user["unit_parent"];

  $dep_a_nos = [];
  foreach ($a_nos as $a_no) {
    if (substr($a_no["a_no"], 0, 6) === $year . substr($dep, 0, 3)) {
      $dep_a_nos[] = $a_no["a_no"];
    }
  }

  // check stream number
  $stream = 0;
  foreach ($dep_a_nos as $dep_a_no) {
    if ((int)substr($dep_a_no, 7, 4) > $stream) {
      $stream = (int)substr($dep_a_no, 7, 4);
    }
  }

  $a_no = $year . $dep . str_pad($stream + 1, 4, "0", STR_PAD_LEFT);
  // DB::create_row("a_no", ["a_no" => $a_no, "ty_pe" => "chrmlist"]);

  $room_id = substr($_POST["selected_room"], 0, 4);
  $room = DB::fetch_row("sl8gdm_room", "room_id", $room_id);
  DB::update_row("sl8gdm_room", ["room_id" => substr($_POST["selected_room"], 0, 4)], ["room_p" => $room["room_p"] + 1, "room_remain" => $room["room_remain"] - 1]);
  DB::create_row("sl8gdm_chrmlist", ["a_no" => $a_no, "stu_cd" => $sid, "room_id" => $_POST["selected_room"], "is_in" => "n", "cho_date" => date("Y-m-d H:i:s"), "cho_p" => $sid]);
  echo "<script>
          alert('操作成功')
          location.href = '/?inner=stu_choice'
        </script>";
} else {
  die();
}
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <a href="/?inner=stu_choice" class="link">線上選寢作業</a>
    /
    <span>選擇寢室</span>
  </p>
  <div class="inner-subtitle">
    <p>選擇寢室</p>
  </div>
  <div class="inner-content stu_choice_unit">
    <h3><?= BUILDINGS[$building] . " 棟 " . $floor . " 樓" ?></h3>
    <table class="inner-table">
      <tr>
        <th>寢室</th>
        <th colspan="2">床位</th>
      </tr>
      <?php foreach ($selected as $room) : ?>
        <tr>
          <td><?= $room["room_id"] ?></td>
          <?php for ($i = 0; $i < 2; $i++) : ?>
            <td>
              <?php if (in_array(trim($room["room_id"]) . str_pad($i + 1, 2, "0", STR_PAD_LEFT), $id_list)) : ?>
                <p>床位不開放</p>
              <?php else : ?>
                <form action="/?inner=stu_choice_unit" method="post">
                  <button class="action-button" name="selected_room" value=<?= trim($room["room_id"]) . str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?>>選擇床位</button>
                </form>
              <?php endif ?>
            </td>
          <?php endfor ?>
        </tr>
      <?php endforeach ?>
    </table>
  </div>

  <style>
    .stu_choice_unit .action-button {
      padding: 0.4em 2em;
    }
  </style>
</div>