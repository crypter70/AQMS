<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredictDataRequest;
use App\Models\TelemetryLog;
use App\Models\PredictionLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MLController extends Controller
{
    public function get()
    {
        $response = Http::get(env('ML_API', '127.0.0.1:6000') . '/');
        $posts = $response->json();

        return response()->json($response);
    }

    public function predict(PredictDataRequest $request)
    {
        $response = Http::post(env('ML_API', '127.0.0.1:6000') . '/predict', [
            "data" => (gettype($request->input("data")) == "string") ?
                json_decode($request->input("data")) : $request->input("data")
        ]);
        $data = $response->json();

        echo "Calling from Laravel: ";
        print_r($data);

        return response()->json($data);
    }

    public function getPredictionResult()
    {
        $loc_1 = $this->getEloquent('1');
        $loc_2 = $this->getEloquent('2');
        $loc_3 = $this->getEloquent('3');
        
        $data_1 = []; $data_2 = []; $data_3 = []; $data_4 = [];
        foreach ($loc_1 as $loc)
        {
            array_push($data_1, $loc->pm1); array_push($data_2, $loc->pm25);
            array_push($data_3, $loc->pm10); array_push($data_4, $loc->co);
        }

        $data_5 = []; $data_6 = []; $data_7 = []; $data_8 = [];
        foreach ($loc_2 as $loc)
        {
            array_push($data_5, $loc->pm1); array_push($data_6, $loc->pm25);
            array_push($data_7, $loc->pm10); array_push($data_8, $loc->co);
        }

        $data_9 = []; $data_10 = []; $data_11 = []; $data_12 = [];
        foreach ($loc_3 as $loc)
        {
            array_push($data_9, $loc->pm1); array_push($data_10, $loc->pm25);
            array_push($data_11, $loc->pm10); array_push($data_12, $loc->co);
        }

        $data = [
            "data_1" => array_map("intval", $data_1),
            "data_2" => array_map("intval", $data_2),
            "data_3" => array_map("intval", $data_3),
            "data_4" => array_map("intval", $data_4),
            "data_5" => array_map("intval", $data_5),
            "data_6" => array_map("intval", $data_6),
            "data_7" => array_map("intval", $data_7),
            "data_8" => array_map("intval", $data_8),
            "data_9" => array_map("intval", $data_9),
            "data_10" => array_map("intval", $data_10),
            "data_11" => array_map("intval", $data_11),
            "data_12" => array_map("intval", $data_12),
        ];
        
        $response = Http::post(env('ML_API', '127.0.0.1:6000') . '/predict', $data);
        $responseData = $response->json();

        return response()->json($responseData);
        // return view('overview', compact('responseData'));
    }

    public function getEloquent($id_device)
    {
        $timelimit = Carbon::now()->subHours(168);
        // return TelemetryLog::select(
        //     DB::raw('DATE(time_captured) as day'),
        //     DB::raw('HOUR(time_captured) as hour'),
        //     DB::raw('AVG(pm_1_0_level) as pm1'),
        //     DB::raw('AVG(pm_2_5_level) as pm25'),
        //     DB::raw('AVG(pm_10_0_level) as pm10'),
        //     DB::raw('AVG(co_level) as co'))
        //         ->where('id_device', '=', $id_device)
        //         ->where('time_captured', '>=', $timelimit)
        //         ->groupBy(DB::raw('DATE(time_captured)'), DB::raw('HOUR(time_captured)'))
        //         ->orderBy('day')
        //         ->orderBy('hour')
        //         ->get();  

       return TelemetryLog::select(
            DB::raw('DATE(time_captured) as day'),
            DB::raw('HOUR(time_captured) as hour'),
            DB::raw('AVG(pm_1_0_level) as pm1'),
            DB::raw('AVG(pm_2_5_level) as pm25'),
            DB::raw('AVG(pm_10_0_level) as pm10'),
            DB::raw('AVG(co_level) as co'))
                ->where('id_device', '=', $id_device)
                ->where('time_captured', '>=', "2024-07-02 00:00:00")
                ->groupBy(DB::raw('DATE(time_captured)'), DB::raw('HOUR(time_captured)'))
                ->take(168)
                ->get();
    }
}
