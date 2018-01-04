<?php
/**
 * Created by PhpStorm.
 * User: TheFatimah
 * Date: 30/12/2017
 * Time: 7:13 PM
 */

$currentYear = \Carbon\Carbon::today()->year;
$years = [];
$expiryYearsForCreditCards = [];
foreach (range(1996, $currentYear) as $year) {
    $years[$year] = $year;
}
foreach (range($currentYear, $currentYear + 10) as $year) {
    $expiryYearsForCreditCards[$year] = $year;
}
$days = [];
$months = [];
foreach (range(1, 31) as $day) {
    $days[$day] = $day;
}
foreach (range(1, 12) as $month) {
    $months[$month] = $month;
}

return [
    'years' => $years,
    'prices' => range(1500, 35000, 500),
    'filters' => [
        'dateDesc' => 'Newest',
        'dateAsc' => 'Oldest',
        'bookingsAsc' => 'Bookings(Low to High)',
        'bookingsDesc' => 'Bookings(High to Low)'
    ],
    'vehicle_status' => ['booked', 'free'],
    'days' => $days,
    'months' => $months,
    'expiryYearsForCreditCards' => $expiryYearsForCreditCards

];