<?php
// time with seconds ex. yyyy-mm-dd hh:mm:ss.sss
$times = DB::fetch_row("sl8gdm_time_limit", "apply_year", $year);
foreach ($times as $key => &$value) {
  if (strlen($value) > 16) {
    // time without seconds ex. yyyy-mm-dd hh:mm
    $value = substr($value, 0, 16);
  }
}
unset($value);
?>

<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>碩、博士生宿舍相關申請期限</span>
  </p>
  <div class="inner-subtitle">
    <p>碩/博士生宿舍相關申請期限</p>
    <p>Application Schedule For The Dormitory</p>
  </div>
  <div class="inner-content div_time">
    <h3><?php echo $year; ?>學年度 相關申請時程表</h3>
    <table class="inner-table" border="1">
      <tr>
        <th>作業項目</th>
        <th>申請期限</th>
      </tr>
      <tr>
        <td>系所單位 & 保障住宿申請</td>
        <td><?php echo $times["dep_open"] . " 至 " . $times["dep_close"]; ?></td>
      </tr>
      <tr>
        <td>原寢開放作業</td>
        <td><?php echo $times["org_open"] . " 至 " . $times["org_close"]; ?></td>
      </tr>
      <tr>
        <td>遞補申請作業</td>
        <td><?php echo $times["stusl_open"] . " 至 " . $times["stusl_close"]; ?></td>
      </tr>
      <tr>
        <td>[碩士房] 線上選寢作業</td>
        <td><?php echo $times["onlsl_open"] . " 至 " . $times["onlsl_close"]; ?></td>
      </tr>
      <tr>
        <td>遞補抽籤公告</td>
        <td><?php echo $times["wait_num_date"]; ?></td>
      </tr>
    </table>
  </div>

  <style>
    .div_time {
      display: flex;
      flex-direction: column;
    }
  </style>
</div>