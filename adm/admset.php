<?php
    if(isset($_POST["add_time_set"])){
        header("location:/?inner=admset_new");
    }
?>
<div class="inner">
    <p class="inner-nav">
        <a href="/" class="link">回首頁</a>
        /
        <span>期初設定</span>
    </p>
    <div class="inner-subtitle">
        <p>研究生宿舍管理作業 期初設定及期限設定</p>
    </div>
    <?php
    // connect DB and fetch data here
    $time_set = [];
    $time_set= DB::fetch_table("sl8gdm_time_limit"); 
    // var_dump($time_set); // print all value in table
    ?>
    <div>
        <table class="inner-table" border="1">
                <tr>
                    <td>學年度</td>
                    <td>系所申請期限</td>
                    <td>遞補申請期限</td>
                    <td>操作</td>
                </tr>
              
                <?php foreach($time_set as $row): ?>
                    <tr>
                        <td><?= $row["apply_year"] ?></td>
                        <td><?= substr($row["dep_open"], 0, 16) ?> 至 <?= substr($row["dep_close"], 0, 16) ?></td>
                        <td><?= substr($row["stusl_open"], 0, 16) ?> 至 <?= substr($row["stusl_close"], 0, 16) ?></td>
                        <td><?= ($row["Is_order_F"] == 'Y') ? "修改" : "無法修改" ?></td>
                    </tr>  
                <?php endforeach; ?>
        </table>
    </div>
    <form class="buttons" action="/?inner=admset_new" method="post">
        <button class="action-button" type="submit" name="add_time_set" >新增</button>    
    </form>


<style>
    .buttons {
            display: flex;
            padding: 2em;
            justify-content: center;
            width: 100%;
            gap: 1em;
        }

    .action-button {
        padding: 0.4em;
        width: 30%;
      }
      
</style>  
    