<?php
    if(isset($_POST["dep"])){
        header("location:/?inner=admset_dep_unit");
    }
?>
<div class="inner">
    <div class="inner-subtitle">系所申請住宿名額管理</div>
    <form action="/?inner=admset_dep_unit" method="post">
        <table class="inner-table">
            <tr style="font-weight: bold;">
                <td align="center">#</td>
                <td align="center">學院</td>
                <td align="center">操作</td>
            </tr>
            <tr>
                <td align="center">1</td>
                <td align="center">1 文學院</td>
                <td align="center">
                    <button type="submit" name="dep" value="1">設定</button>
                </td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td align="center">2 理學院</td>
                <td align="center">
                    <button type="submit" name="dep" value="2">設定</button>
                </td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td align="center">3 工學院</td>
                <td align="center">
                    <button type="submit" name="dep" value="3">設定</button>
                </td>
            </tr>
            <tr>
                <td align="center">4</td>
                <td align="center">4 社會科學院</td>
                <td align="center">
                    <button type="submit" name="dep" value="4">設定</button>
                </td>
            </tr>
            <tr>
                <td align="center">5</td>
                <td align="center">5 法學院</td>
                <td align="center">
                    <button type="submit" name="dep" value="5">設定</button>
                </td>
            </tr>
        </table>
    </form>
</div>