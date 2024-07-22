<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\TelemetryLog;
use Flasher\Prime\FlasherInterface;
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

        flash()->addWarning(NotifController::checkAirQuality());
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

    
}
