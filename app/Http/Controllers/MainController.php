<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Illuminate\Http\Request;

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
        
        return response()->json($data);
    }
}
