<?php
include "../include/lib_loadpdf.php";

require_once "../class/Token.php";

require_once "../class/DB.php";

if (!isset($_COOKIE["jwt"])) {
  echo "<script>
          alert('請先登入')
          window.location.href = '/'
        </script>";
  die();
}

[$payload, $access_token] = Token::verify($_GET["token"], $_COOKIE["jwt"]);

if (!$payload || $payload["perm"] !== "dep") {
  echo "<script>
            alert('未授權')
            window.location.href = '/'
          </script>";
  die();
}

$user = DB::fetch_row("sl8gdm_permit_rec", "staff_cd", $payload["acc"]);
$dep = DB::fetch_row("sl8gdm_dep", "unit_parent", $user["unit_parent"]);
$data = DB::fetch_table("sl8gdm_dep_stuapply");

$pdf->Cell(0, 16, "碩、博士生宿舍申請名單 -- " . trim($dep["unit_name"]), 0, 1, "C");
$pdf->Ln(5);

$pdf->SetFont("NotoSans", "", 15);

$width = [40, 20, 30, 30, 70];
$choice = ["s" => "自選寢", "m" => "管排寢", "o" => "原寢"];

$pdf->Cell($width[0], 10, "學號", 1, 0, "C");
$pdf->Cell($width[1], 10, "性別", 1, 0, "C");
$pdf->Cell($width[2], 10, "選寢方式", 1, 0, "C");
$pdf->Cell($width[3], 10, "換寢次數", 1, 0, "C");
$pdf->Cell($width[4], 10, "備註", 1, 1, "C");

foreach ($data as $d) {
  if ($d["stu_cd"][3] === $dep["unit_parent"][0]) {
    $pdf->Cell($width[0], 10, $d["stu_cd"], 1, 0, "C");
    $pdf->Cell($width[1], 10, $d["sex"], 1, 0, "C");
    $pdf->Cell($width[2], 10, $choice[$d["choice_type"]], 1, 0, "C");
    $pdf->Cell($width[3], 10, $d["is_chg"], 1, 0, "C");
    $pdf->Cell($width[4], 10, $d["factor"], 1, 1);
  }
}

$pdf->Output('I', '申請名冊.pdf', true);
