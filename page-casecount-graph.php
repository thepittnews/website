<?php
/**
* Template Name: Case count Graph
*
*/

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

$csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTwWCQl2QwJyfaIBM3x99qWnFlVg3rXHWZBZmWLc97UcAKDnOS5b_LmViFbfAaljl4rdwiNpZD10sru/pub?gid=0&single=true&output=csv';
$fileContents = file_get_contents($csvUrl);
$rows = array_map("str_getcsv", explode("\r\n", $fileContents));
array_shift($rows);

$dates_arr = array('');

// Transform CSV data into arrays
for($i = 1; $i <= count($rows); $i++) {
  if (strpos($rows[$i][0], '2020') !== false) {
    $dates_arr[] = explode("/2020", $rows[$i][0])[0] . "/20";
  }

  if (strpos($rows[$i][0], '2021') !== false) {
    $dates_arr[] =  explode("/2021", $rows[$i][0])[0] . "/21";
  }
}

// Stop axes where data ends
$stop_index = array_search(date('n/j/y'), $dates_arr, true);

$dates_arr = array_slice($dates_arr, 0, $stop_index + 1, true);
$rows = array_slice($rows, 0, $stop_index + 1, true);

$out = fopen('php://output', 'w');
fputcsv($out, $dates_arr);

function get_student_case($row) {
  return $row[1];
}

function get_employee_case($row) {
  return $row[2];
}

function get_15213_case($row) {
  return $row[5];
}

fputcsv($out, array_map('get_student_case', $rows));
fputcsv($out, array_map('get_employee_case', $rows));
fputcsv($out, array_map('get_15213_case', $rows));

fclose($out);
?>
