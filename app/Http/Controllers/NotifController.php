<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotifController extends Controller
{
    public static function checkAirQuality()
    {
        $latestData = TelemetryLog::latest()->first();

        $maxIspu = max($latestData->ispu_pm25, $latestData->ispu_pm10, $latestData->ispu_co);
        $category = '';

        if ($maxIspu <= 50) {
            $category = 'Good';
        } elseif ($maxIspu <= 100) {
            $category = 'Moderate';
        } elseif ($maxIspu <= 200) {
            $category = 'Unhealthy';
        } elseif ($maxIspu <= 300) {
            $category = 'Very Unhealthy';
        } else {
            $category = 'Hazardous';
        }

        if ($category != 'Good') {
            $message = "You are in $category zone.";
            return $message;
        }
    }
}
