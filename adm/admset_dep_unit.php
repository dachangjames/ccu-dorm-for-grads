<div class="inner">
    <div class="inner-subtitle">
        <p>系所申請名額設定</p>
        <p class="inner-nav">
            <a href="/?inner=admset_dep" class="link">回上頁</a>
        </p>
	</div>
	<?php 
	$deps = [
		1 => "中國文學研究所",
		2 => "數學研究所",
		3 => "資訊工程研究所",
		4 => "心理研究所",
		5 => "法律研究所"
	];
	foreach($deps as $dNum => $dName){
        echo "<form action='/?inner=admset_dep_unit' method='post' style='display:none'>";
        echo "<table class='inner-table'>";
        echo "<tr style='font-weight: bold;'>";
        echo "<td align='center'>#</td>";
        echo "<td align='center'>系所單位</td>";
        echo "<td align='center'>男生名額</td>";
        echo "<td align='center'>女生名額</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td align='center'>$dNum</td>";
        echo "<td align='center'>$dNum $dName</td>";
        echo "<td align='center'>";
        echo "<input type='number' name='num_m_$dNum' placeholder='0' required>";
        echo "<label>人</label>";
        echo "</td>";
        echo "<td align='center'>";
        echo "<input type='number' name='num_f_$dNum' placeholder='0' required>";
        echo "<label>人</label>";
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td align='center' colspan='2'>";
        echo "<input type='submit' name='Quota_$dNum' value='Submit' class='action-button'>";
        echo "</td>";
        echo "<td align='center' colspan='2'>";
        echo "<input type='reset' value='Clear' class='action-button'>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</form>";
	}
?>

<?php
    $upd_Table = "sl8gdm_dep";
    if(isset($_POST["dep"])){
        switch($_POST["dep"]){
            case 1:
                echo "<script>document.getElementById('literature').style.display='block';</script>";
                break;
            case 2:
                echo "<script>document.getElementById('science').style.display='block';</script>";
                break;
            case 3:
                echo "<script>document.getElementById('engineering').style.display='block';</script>";
                break;
            case 4:
                echo "<script>document.getElementById('socialscience').style.display='block';</script>";
                break;
            case 5:
                echo "<script>document.getElementById('law').style.display='block';</script>";
                break;
        }
        $_SESSION["dep"]=$_POST["dep"];
    }

    // $row=DB::fetch_row("sl8gdm_dep", "unit_parent", $_SESSION["dep"]*1000);
    // foreach($row as $key => $value){
    //     echo "{$key} : {$value}<br>";
    // }

    if(isset($_POST["Quota"])){
        switch($_SESSION["dep"]){
            case 1:
                $num_m=$_POST["Liter_m_count"];    //FILTER_SANITIZE_NUMBER_INT
                $num_f=$_POST["Liter_f_count"];
                $upd_Row = array("unit_parent"=>"1000");
                break;
            case 2:
                $num_m=$_POST["Math_m_count"];
                $num_f=$_POST["Math_f_count"];
                $upd_Row = array("unit_parent"=>"2000");
                break;
            case 3:
                $num_m=$_POST["CS_m_count"];
                $num_f=$_POST["CS_f_count"];
                $upd_Row = array("unit_parent"=>"3000");
                break;
            case 4:
                $num_m=$_POST["Psyco_m_count"];
                $num_f=$_POST["Psyco_f_count"];
                $upd_Row = array("unit_parent"=>"4000");
                break;
            case 5:
                $num_m=$_POST["Law_m_count"];
                $num_f=$_POST["Law_f_count"];
                $upd_Row = array("unit_parent"=>"5000");
                break;
        }
        DB::update_row($upd_Table, $upd_Row, ["a_num_m"=>$num_m]);
        DB::update_row($upd_Table, $upd_Row, ["a_num_f"=>$num_f]);
        // $row=DB::fetch_row("sl8gdm_dep", "unit_parent", $_SESSION["dep"]*1000);
        // foreach($row as $key => $value){
        //     echo "{$key} : {$value}<br>";
        // }
        echo "<script>location.replace('/?inner=admset_dep');</script>";
    }
?>
