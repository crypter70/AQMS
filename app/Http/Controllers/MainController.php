<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $value = $request->session()->get("id_device", 1);
        $data = TelemetryLog::where('id_device', $value)->orderBy('time_captured', 'desc')->first();
        return view('overview', compact('data'));
    }

    public function get_data($data)
    {
        $data = TelemetryLog::where('id_device', $data)->orderBy('time_captured', 'desc')->first();
        $ispu = TelemetryLog::where('');
        
        return response()->json($data);
    }

    public function getAverageReadings()
    {
        $now = Carbon::now();
        $yesterday = Carbon::now()->subDay();

        $deviceId = session('id_device', 1);
        $readings = TelemetryLog::where('id_device', $deviceId)->whereBetween('time_captured', [$yesterday, $now])->get();

        // average PM2.5, PM10, CO
        $averagePM25 = $readings->avg('pm_2_5_level');
        $averagePM10 = $readings->avg('pm_10_0_level');
        $averageCO = $readings->avg('co_level');

        return response()->json([
            'pm_2_5' => $averagePM25,
            'pm_10' => $averagePM10,
            'co' => $averageCO,
            ]);
    }


}
