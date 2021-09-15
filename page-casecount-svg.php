<?php
/**
* Template Name: Case count SVG
*
*/

error_reporting(E_ERROR);
header('Content-Type: image/svg+xml');

$csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTwWCQl2QwJyfaIBM3x99qWnFlVg3rXHWZBZmWLc97UcAKDnOS5b_LmViFbfAaljl4rdwiNpZD10sru/pub?gid=317656469&single=true&output=csv';
$svgHeader = '<?xml version="1.0" standalone="no"?>
  <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
  "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
  <svg width="320" height="150" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <style>
      @import(<![CDATA["https://fonts.googleapis.com/css?family=Roboto:400&display=swap&ver=5.4.2"]]>);
      text {
        dominant-baseline: baseline;
        text-anchor: middle;
        fill: black;
        font-weight: 400;
        font-family: Roboto;
      }
    </style>

    <rect width="320" height="150" style="fill: white; stroke-width: 5; stroke: rgb(0,0,0)" /> <!-- rgb(0,0,255); -->
    <a href="https://pittnews.com/covid19"  target="_blank">
      <text x="50%" y="15%" font-size="1.4em">Pitt Community COVID-19 Info</text>
    </a>
';

$fileContents = file_get_contents($csvUrl);
$rows = str_getcsv(explode("\r\n", $fileContents)[1]);

echo $svgHeader . '
    <text x="50%" y="30%" font-size="1.1em">Cases as of ' . $rows[0] . '</text>
    <text x="55%" y="40%" font-size="0.9em">Employees</text>
    <text x="85%" y="40%" font-size="0.9em">Students</text>

    <text x="20%" y="50%" font-size="0.9em">From last report</text>
    <text x="55%" y="50%" font-size="0.9em">' . $rows[1] . '</text>
    <text x="85%" y="50%" font-size="0.9em">' . $rows[3] . '</text>

    <text x="20%" y="60%" font-size="0.9em">Total</text>
    <text x="55%" y="60%" font-size="0.9em">' . $rows[2] . '</text>
    <text x="85%" y="60%" font-size="0.9em">' . $rows[4] . '</text>

    <text x="50%" y="75%" font-size="1.1em">Vaccination rates as of ' . $rows[0] . '</text>
    <text x="20%" y="85%" font-size="0.9em">Faculty</text>
    <text x="45%" y="85%" font-size="0.9em">Staff</text>
    <text x="75%" y="85%" font-size="0.9em">UG Students</text>

    <text x="20%" y="95%" font-size="0.9em">' . $rows[5] . '%</text>
    <text x="46%" y="95%" font-size="0.9em">' . $rows[6] . '%</text>
    <text x="75%" y="95%" font-size="0.9em">' . $rows[7] . '%</text>
  </svg>
';
?>
