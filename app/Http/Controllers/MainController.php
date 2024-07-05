<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TelemetryLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        if(!session()->has("id_device"))
        {
            session(["id_device" => '1']);
        }

        $id = session("id_device", '1');
        
        $device = Device::all();
        $data = TelemetryLog::where('id_device', $id)->orderBy('time_captured', 'desc')->first();
        $ispu =  ISPUController::get_ispu($id);

        return view('overview', compact('data', 'device', 'ispu'));
    }

    public function airmap()
    {
        $devices = Device::all();
        $ispu['1'] =  ISPUController::get_ispu('1');
        $ispu['2'] =  ISPUController::get_ispu('2');
        $ispu['3'] =  ISPUController::get_ispu('3');

        for($i = 1; $i <= 3; $i++)
        {
            if(($ispu[$i]['pm25'] >= $ispu[$i]['pm10']) && ($ispu[$i]['pm25'] >= $ispu[$i]['co']))
            {
                $ispu[$i]['highest'] = $ispu[$i]['category_pm25'];
            }
            else if(($ispu[$i]['pm10'] >= $ispu[$i]['pm25']) && ($ispu[$i]['pm10'] >= $ispu[$i]['co']))
            {
                $ispu[$i]['highest'] = $ispu[$i]['category_pm10'];
            }
            else
            {
                $ispu[$i]['highest'] = $ispu[$i]['category_co'];
            }
        }

        return view('airmap', compact('devices', 'ispu'));
    }

    // public function getAverageReadings()
    // {
    //     $now = Carbon::now();
    //     $yesterday = Carbon::now()->subDay();

    //     $deviceId = session('id_device', 1);
    //     $readings = TelemetryLog::where('id_device', $deviceId)->whereBetween('time_captured', [$yesterday, $now])->get();

    //     // average PM2.5, PM10, CO
    //     $averagePM25 = $readings->avg('pm_2_5_level');
    //     $averagePM10 = $readings->avg('pm_10_0_level');
    //     $averageCO = $readings->avg('co_level');

    //     return response()->json([
    //         'pm_2_5' => $averagePM25,
    //         'pm_10' => $averagePM10,
    //         'co' => $averageCO,
    //         ]);
    // }

    /* private function getNotifications($value, $type)
    {
        $category = $this->getCategory($value, $type);
        $notifications = [];

        if ($category == 'Unhealthy' || $category == 'Very Unhealthy' || $category == 'Hazardous') {
            $notifications[] = "Warning: You are in a $category zone!";
        }

        return $notifications;
    } */
}
