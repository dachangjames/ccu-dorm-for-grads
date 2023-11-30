<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>登入系統</span>
  </p>
  <div class="inner-subtitle">
    <p>登入系統</p>
    <p>Login</p>
  </div>
  <!-- user input form -->
  <form method="post" action="include/lib_login.php" class="inner-content pg_login">
    <div class="input-box">
      <input type="text" name="acc" required />
      <label for="acc">帳號</label>
    </div>
    <div class="input-box">
      <input type="password" name="pw" required />
      <label for="pw">密碼</label>
      <i class='bx bx-show'></i>
      <i class='bx bx-hide'></i>
    </div>
    <button type="submit" class="action-button">登入</button>
    <?php
    if (isset($_GET["auth"])) {
      echo "<p class='failed'>";
      if ($_GET["auth"] === "401") {
        echo "帳號或密碼錯誤";
      } else if ($_GET["auth"] === "403") {
        echo "密碼錯誤";
      }
      echo "</p>";
    }
    ?>
  </form>

  <style>
    .pg_login {
      grid-template-columns: repeat(2, 1fr);
      place-self: center;
    }

    .pg_login input {
      width: 100%;
    }

    .pg_login>button {
      grid-column: 1 / -1;
      width: 100%;
    }

    .pg_login>.failed {
      color: red;
      font-size: 1.2em;
      grid-column: 1 / -1;
    }
  </style>
</div>