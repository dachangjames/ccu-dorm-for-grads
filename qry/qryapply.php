<div class="inner">
  <p class="inner-nav">
    <a href="/" class="link">回首頁</a>
    /
    <span>住宿申請名單查詢</span>
  </p>
  <div class="inner-subtitle">
    <p>住宿申請名單查詢</p>
  </div>

  <div class="inner-content qryapply">
      <table class="inner-table" border="1">
        <tr>
            <th>學號</th>
            <th>性別</th>
            <th>申請日期</th>
        </tr>
        <?php
            $apply_list=DB::fetch_table("sl8gdm_dep_stuapply");
            $sex=null;
            foreach($apply_list as $row){
                if($row['del_chk'] == "G"){
                    continue;
                }
                if($row["sex"] == "F"){
                    $sex="女";
                }else{
                    $sex="男";
                }
                echo"<tr>
                        <td>{$row['stu_cd']}</td>
                        <td>{$sex}</td>
                        <td>{$row['a_date']}</td>
                    </tr>";
            }
        ?>
      </table>
  </div>
  <style>
    .qryapply {
        grid-template-columns: 70%;
    }
    .qryapply > .inner-table {
      table-layout: auto;
    }
  </style>
</div>