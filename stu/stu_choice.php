<?php
$sex = $_SESSION["account"]["sex"];
$sid = $_SESSION["account"]["acc"];
$all_rooms = DB::fetchAll_rows("sl8gdm_room", "room_sex", $sex);
const BUILDINGS = ["1" => "A", "2" => "B", "3" => "C", "4" => "D", "5" => "E"];
$sum = ["A" => 0, "B" => 0, "C" => 0, "D" => 0, "E" => 0];
foreach ($all_rooms as $room) {
  $sum[BUILDINGS[$room["room_id"][0]]] += $room["room_remain"];
  $catgorized_rooms[BUILDINGS[$room["room_id"][0]]][$room["room_id"][1]][] = $room;
}
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>線上選寢作業</span>
  </p>
  <div class="inner-subtitle">
    <p>線上選寢作業</p>
  </div>
  <div class="inner-content stu_choice">
    <h3>學號：<?= $sid ?></h3>
    <h3>請選擇排寢棟別及樓層</h3>
    <table class="inner-table">
      <?php foreach ($catgorized_rooms as $building => $floors) : ?>
        <tr>
          <th><?= $building ?> 棟</th>
          <th>空床總數：<?= $sum[$building] ?></th>
        </tr>
        <?php foreach ($floors as $floor) : ?>
          <?php
          $floor_sum = 0;
          foreach ($floor as $room) {
            $floor_sum += $room["room_remain"];
          }
          ?>
          <tr>
            <td>
              <?php if ($room["room_remain"] == 0) : ?>
                <p><?= $room["room_id"][1] ?> 樓</p>
              <?php else : ?>
                <form action="/?inner=stu_choice_unit" method="post">
                  <button class="action-button" name="select" value=<?= substr($room["room_id"], 0, 2) ?>><?= $room["room_id"][1] ?> 樓</button>
                </form>
              <?php endif ?>
            </td>
            <td>
              <p>空床數：<?= $floor_sum ?></p>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endforeach ?>
    </table>
  </div>

  <style>
    .stu_choice .inner-table {
      width: 60%;
    }

    .stu_choice .action-button {
      padding: 0.4em 2em;
    }
  </style>
</div>