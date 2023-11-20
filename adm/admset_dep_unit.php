<div class="inner">
    <div class="inner-subtitle">系所申請名額設定</div>
    <!-- 文學院 -->
    <form action="/?inner=admset_dep_unit" method="post" id="literature" style="display:none">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">系所單位</td>
                <td align="center">男生名額</td>
                <td align="center">女生名額</td>
            </tr>
            <tr>
                <td align="center">1</td>
                <td align="center">1000 中國文學研究所</td>
                <td align="center">
                    <input type="number" name="Liter_m_count" placeholder="0" required>
                    <label>人</label>
                </td>
                <td align="center">
                    <input type="number" name="Liter_f_count" placeholder="0" required>
                    <label>人</label>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="Quota" value="Submit">
                </td>
                <td align="center" colspan="2">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <!-- 理學院 -->
    <form action="/?inner=admset_dep_unit" method="post" id="science" style="display:none">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">系所單位</td>
                <td align="center">男生名額</td>
                <td align="center">女生名額</td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td align="center">2000 數學研究所</td>
                <td align="center">
                    <input type="number" name="Math_m_count" placeholder="0" required>
                    <label>人</label>
                </td>
                <td align="center">
                    <input type="number" name="Math_f_count" placeholder="0" required>
                    <label>人</label>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="Quota" value="Submit">
                </td>
                <td align="center" colspan="2">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <!-- 工學院 -->
    <form action="/?inner=admset_dep_unit" method="post" id="engineering" style="display:none">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">系所單位</td>
                <td align="center">男生名額</td>
                <td align="center">女生名額</td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td align="center">3000 資訊工程研究所</td>
                <td align="center">
                    <input type="number" name="CS_m_count" placeholder="0" required>
                    <label>人</label>
                </td>
                <td align="center">
                    <input type="number" name="CS_f_count" placeholder="0" required>
                    <label>人</label>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="Quota" value="Submit">
                </td>
                <td align="center" colspan="2">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <!-- 社科院 -->
    <form action="/?inner=admset_dep_unit" method="post" id="socialscience" style="display:none">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">系所單位</td>
                <td align="center">男生名額</td>
                <td align="center">女生名額</td>
            </tr>
            <tr>
                <td align="center">4</td>
                <td align="center">4000 心理研究所</td>
                <td align="center">
                    <input type="number" name="Psyco_m_count" placeholder="0" required>
                    <label>人</label>
                </td>
                <td align="center">
                    <input type="number" name="Psyco_f_count" placeholder="0" required>
                    <label>人</label>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="Quota" value="Submit">
                </td>
                <td align="center" colspan="2">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <!-- 法學院 -->
    <form action="/?inner=admset_dep_unit" method="post" id="law" style="display:none">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">系所單位</td>
                <td align="center">男生名額</td>
                <td align="center">女生名額</td>
            </tr>
            <tr>
                <td align="center">5</td>
                <td align="center">5000 中國文學研究所</td>
                <td align="center">
                    <input type="number" name="Law_m_count" placeholder="0" required>
                    <label>人</label>
                </td>
                <td align="center">
                    <input type="number" name="Law_f_count" placeholder="0" required>
                    <label>人</label>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="Quota" value="Submit">
                </td>
                <td align="center" colspan="2">
                    <input type="reset" value="Clear">
                </td>
            </tr>
        </table>
    </form>
    <div class="inner-subtitle" style="justify-content:center">
        <a href="/?inner=admset_dep">[回上頁]</a>
    </div>
</div>

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
                $num_m=$_POST["Liter_m_count"];
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
    }
?>