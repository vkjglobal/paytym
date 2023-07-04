<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollFunctionsController extends Controller
{
    public function groupPayPeriodByWeeks(CarbonPeriod $payPeriod)
{
    $weeks = [];

    foreach ($payPeriod as $date) {
        $weekNumber = $date->weekOfYear;
        if (!isset($weeks[$weekNumber])) {
            // Create a new week period if it doesn't exist
            $weekStart = $date->copy()->startOfWeek();
            $weekEnd = $date->copy()->endOfWeek();
            $weeks[$weekNumber] = CarbonPeriod::since($weekStart)->until($weekEnd);
        }
    }

    return array_values($weeks);
}

}
