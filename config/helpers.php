<?php
/**
 * Created by PhpStorm.
 * User: TheFatimah
 * Date: 30/12/2017
 * Time: 7:13 PM
 */

$currentYear = \Carbon\Carbon::today()->year;
$years = [];
foreach (range(1996, $currentYear) as $year) {
    $years[$year] = $year;
}
return [
    'years' => $years,
    'prices' => range(1500, 35000, 500)
];