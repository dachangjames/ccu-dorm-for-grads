<?php
function sort_time($anns)
{
  // bubble sort
  $len = count($anns);
  $sorting = true;
  while ($sorting) {
    $sorting = false;
    for ($i = 0; $i < $len - 1; $i++) {
      $t1 = strtotime($anns[$i]["mod_time"]);
      $t2 = strtotime($anns[$i + 1]["mod_time"]);
      if ($t1 < $t2) {
        $temp = $anns[$i];
        $anns[$i] = $anns[$i + 1];
        $anns[$i + 1] = $temp;
        $sorting = true;
      }
    }
  }
  return $anns;
}

function sort_anns($anns)
{
  $top = [];
  $normal = [];
  foreach ($anns as $ann) {
    if ($ann["is_top"] === "y") {
      $top[] = $ann;
    } else {
      $normal[] = $ann;
    }
  }

  $sorted = array_merge(sort_time($top), sort_time($normal));
  return $sorted;
}
