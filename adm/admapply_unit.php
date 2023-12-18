<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <a href="/?inner=admapply" class="link">住宿資格申請(管理員)</a>
    /
    <span>住宿申請資料填寫(管理員)</span>
  </p>
  <div class="inner-subtitle">
    <p>住宿申請資料填寫(管理員)</p>
  </div>
  <?php
  if (!isset($_SESSION["adm"]))
  {
    die();
  }
  else if (isset($_POST["sid"]) && !isset($_POST["op"]))
  {
    $dep = $_SESSION["adm"];
    $stu_cd = $_POST["sid"];
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $sex = isset($_POST["sex"]) ? "F" : "M";
    $choice = $_POST["choice"];
    $old = isset($_POST["old"]) ? $_POST["old"] : null;
    $desc = isset($_POST["desc"]) ? $_POST["desc"] : null;

    // invalid sid
    if (strlen($stu_cd) !== 9 && $_POST["op"] === "add") {
      echo "<script>
              alert('學號格式錯誤')
              window.location.href = '/?inner=admapply_unit'
            </script>";
    }

    // get all dep_stuapply a_nos
    $a_nos = DB::fetchAll_rows("a_no", "ty_pe", "dep_stuapply");
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
    DB::create_row("a_no", ["a_no" => $a_no, "ty_pe" => "dep_stuapply"]);

    // check is_chg
    $prev = DB::fetch_row("sl8gdm_dep_stuapply", "stu_cd", $stu_cd);
    if ($choice === "o" && $prev) {
      $is_chg = $prev;
    } else if ($prev) {
      $is_chg = $prev["is_chg"] + 1;
    } else if ($old) {
      $is_chg = 1;
    } else {
      $is_chg = 0;
    }

    if ($prev) {
      $success = DB::update_row(
        "sl8gdm_dep_stuapply",
        ["stu_cd" => $stu_cd],
        [
          "choice_type" => $choice,
          "org_room" => $old === null ? $prev["org_room"] : $old,
          "factor" => $desc === null ? $prev["factor"] : $desc,
          "a_date" => date("Y-m-d H:i:s"),
          "is_chg" => $is_chg
        ]
      );
    } else {
      $success = DB::create_row(
        "sl8gdm_dep_stuapply",
        [
          "a_no" => $a_no,
          "stu_cd" => $stu_cd,
          "sex" => $sex,
          "unit_parent" => $dep,
          "permit_cd" => "sto",
          "choice_type" => $choice,
          "del_chk" => "N",
          "org_room" => $old,
          "factor" => $desc,
          "a_date" => date("Y-m-d H:i:s"),
          "is_chg" => $is_chg
        ]
      );
    }

    if ($success === false) {
      echo "<script>
              alert('操作失敗')
              window.location.href = '/?inner=admapply_unit'
            </script>";
    } else {
      $count = $sex === "M" ? "m_count" : "f_count";
      $row = DB::fetch_row("sl8gdm_dep", "unit_parent", $dep);
      $prev_count = $row[$count];
      DB::update_row("sl8gdm_dep", ["unit_parent" => $dep], [$count => $prev_count + 1]);
      DB::create_row("a_no", ["a_no" => $a_no, "ty_pe" => "dep_stuapply"]);
      echo "<script>
              alert('操作成功')
              window.location.href = '/?inner=admapply'
            </script>";
    }
  }
  ?>
  <form class="inner-content admapply_unit" action="/?inner=admapply_unit" method="post">
    <h3>申請單位：<?php echo $_SESSION["adm"] ?></h3>
    <?php if (($_POST["op"] === "add")) : ?>
      <div class="input-box">
        <input type="text" name="sid" required>
        <label>學號</label>
      </div>
      <div class="input-box">
        <input type="text" name="name" required>
        <label>姓名</label>
      </div>
      <div class="input-switch">
        <span for="sex">性別：</span>
        <label class="selected">男</label>
        <input type="checkbox" name="sex">
        <label>女</label>
      </div>
    <?php elseif ($_POST["op"] === "update") : ?>
      <input type="text" name="sid" value=<?= $_POST["sid"] ?> hidden>
    <?php endif ?>
    <div class="input-select">
      <span>選寢方式：</span>
      <select name="choice">
        <option value="m">管理員排定寢室</option>
        <option value="s">自選寢室</option>
        <option value="o">原寢室</option>
      </select>
      <i class='bx bx-chevron-down'></i>
    </div>
    <div class="input-box">
      <input type="text" name="old">
      <label>原寢室代號</label>
    </div>
    <div class="input-box description">
      <input type="text" name="desc">
      <label>備註</label>
    </div>
    <div class="buttons">
      <button class="action-button" type="submit">送出</button>
      <button class="action-button" type="reset">重填</button>
      <button class="action-button" type="button" onclick="window.location.href = '/?inner=admapply'">回上一頁</button>
    </div>
  </form>

  <style>
    .admapply_unit {
      place-content: start;
      justify-self: center;
      justify-content: center;
      grid-template-columns: 1fr 1fr;
      gap: 1em 2em;
      width: 60%;
    }

    .admapply_unit>h3,
    .admapply_unit>.description,
    .admapply_unit>.buttons {
      grid-column: -1 / 1;
    }

    .admapply_unit>.input-box>input {
      width: 100%;
    }

    .admapply_unit>.buttons {
      display: flex;
      gap: 2em;
      justify-content: center;
      width: 100%;
    }

    .admapply_unit .action-button {
      width: 100px;
    }

    @media (width < 1500px) {
      .admapply_unit {
        width: 90%;
      }
    }
  </style>

  <script src="js/inputSwitch.js"></script>
</div>