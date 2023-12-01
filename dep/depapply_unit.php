<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <a href="/?inner=depapply" class="link">住宿資格申請</a>
    /
    <span>住宿申請資料填寫</span>
  </p>
  <div class="inner-subtitle">
    <p>住宿申請資料填寫</p>
  </div>
  <?php
  if (!isset($_POST["dep"])) {
    var_dump($_POST);
    die();
  }
  ?>
  <form class="inner-content depapply_unit" action="/?inner=depapply_unit" method="post">
    <h3>申請單位：<?php echo $_POST["dep"] ?></h3>
    <div class="input-box">
      <input type="text" name="sid" required>
      <label>學號</label>
    </div>
    <div class="input-box">
      <input type="text" name="name" required>
      <label>姓名</label>
    </div>
    <div class="input-box">
      <input type="password" name="pid" required>
      <label>身份證字號</label>
      <i class='bx bx-show'></i>
      <i class='bx bx-hide'></i>
    </div>
    <div class="input-switch">
      <span for="sex">性別：</span>
      <label class="selected">男</label>
      <input type="checkbox" name="sex">
      <label>女</label>
    </div>
    <div class="input-box description">
      <input type="text" name="desc">
      <label>備註</label>
    </div>
    <div class="input-box">
      <input type="text" name="mobile" required>
      <label>手機號碼</label>
    </div>
    <div class="input-box">
      <input type="text" name="phone">
      <label>聯絡電話</label>
    </div>
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
    <div class="buttons">
      <button class="action-button" type="submit">送出</button>
      <button class="action-button" type="reset">重填</button>
    </div>
  </form>

  <style>
    .depapply_unit {
      place-content: start;
      justify-self: center;
      justify-content: center;
      grid-template-columns: 1fr 1fr;
      gap: 1em 2em;
      width: 60%;
    }

    .depapply_unit>h3,
    .depapply_unit>.description,
    .depapply_unit>.buttons {
      grid-column: -1 / 1;
    }

    .depapply_unit>.input-box>input {
      width: 100%;
    }

    .depapply_unit>.buttons {
      display: flex;
      gap: 2em;
      justify-content: center;
      width: 100%;
    }

    .depapply_unit .action-button {
      width: 100px;
    }

    @media (width < 1500px) {
      .depapply_unit {
        width: 90%;
      }
    }
  </style>

  <script src="js/inputSwitch.js"></script>
</div>