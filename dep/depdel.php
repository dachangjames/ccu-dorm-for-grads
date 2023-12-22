<?php
if (isset($_POST["a_no"])) {
  $success = DB::update_row("sl8gdm_dep_stuapply", ["a_no" => $_POST["a_no"]], ["del_chk" => "G"]);
  echo "<script>alert('操作" . ($success ? "成功" : "失敗") . "')</script>";
}

$unit = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $_SESSION["account"]["acc"]);
$unit_parent = $unit["unit_parent"];
$_SESSION["dep"] = $unit_parent;
$dep = DB::fetch_row("sl8gdm_dep", "unit_parent", $unit_parent);
$unit_name = $dep["unit_name"];
$stuapply = DB::fetchAll_rows("sl8gdm_dep_stuapply", "unit_parent", $unit_parent);
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>放棄床位申請</span>
  </p>
  <div class="inner-subtitle">
    <p>放棄床位申請</p>
  </div>
  <div class="inner-content depdel">
    <h3>申請單位：<?php echo "$unit_parent $unit_name" ?></h3>
    <?php if ($stuapply) : ?>
      <table class="inner-table" border="1">
        <tr>
          <th>申請編號</th>
          <th>學號</th>
          <th>性別</th>
          <th>選寢方式</th>
          <th>操作</th>
        </tr>
        <?php foreach ($stuapply as $apply) : ?>
          <?php
          if ($apply["choice_type"] === "s") {
            $choice = "自選寢室";
          } else if ($apply["choice_type"] === "m") {
            $choice = "管理員排定寢室";
          } else {
            $choice = "原寢室";
          }
          ?>
          <tr>
            <td><?= $apply["a_no"] ?></td>
            <td><?= $apply["stu_cd"] ?></td>
            <td><?= $apply["sex"] === "M" ? "男" : "女" ?></td>
            <td><?= $choice ?></td>
            <td>
              <form action="/?inner=depdel" method="POST">
                <?php if ($apply["del_chk"] === "G") : ?>
                  <p>放棄待確認</p>
                <?php else : ?>
                  <button class="action-button" name="a_no" value=<?= $apply["a_no"] ?>>放棄</button>
                <?php endif ?>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </table>
    <?php else : ?>
      <p>貴系所無住宿名單，故無法進行申請。</p>
    <?php endif ?>
  </div>

  <style>
    .depdel {
      grid-template-columns: 70%;
    }

    .depdel>.inner-table {
      table-layout: auto;
    }

    .depdel .action-button {
      padding: 0.6em 2em;
    }
  </style>
</div>