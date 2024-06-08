<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $data = TelemetryLog::orderBy('time_captured', 'desc')->first();
        return view('overview', compact('data'));
    }
}
