<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ISPUController extends Controller
{
    public static function get_ispu($device)
    {
        $today = Carbon::now();
        $yesterday = Carbon::now()->subDay();

        // DEBUG / SIMULATION PURPOSE.
        $data = TelemetryLog::where('id_device', $device)->get();

        // Hitung rata-rata PM2.5, PM10, dan CO
        $average_pm25 = $data->avg('pm_2_5_level');
        $average_pm10 = $data->avg('pm_10_0_level');
        $average_co = $data->avg('co_level');

        // Menghitung ISPU menggunakan rumus yang telah diberikan
        $ispu['pm25'] = ISPUController::calculate_ispu($average_pm25, 'PM2.5');
        $ispu['pm10'] = ISPUController::calculate_ispu($average_pm10, 'PM10');
        $ispu['co'] = ISPUController::calculate_ispu($average_co, 'CO');

        $ispu['category_pm25'] = ISPUController::categorize_ispu($ispu['pm25']);
        $ispu['category_pm10'] = ISPUController::categorize_ispu($ispu['pm10']);
        $ispu['category_co'] = ISPUController::categorize_ispu($ispu['co']);

        return $ispu;
    }

    public function getAverageISPUperDay()
    {
        $data = TelemetryLog::select(
            DB::raw("DATE_FORMAT(created_at, '%a') as day"),
            DB::raw("AVG(ispu_pm25) as pm25"),
            DB::raw("AVG(ispu_pm10) as pm10"),
            DB::raw("AVG(ispu_co) as co")
        )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%a')"))
            ->orderByRaw("FIELD(DATE_FORMAT(created_at, '%a'), 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')")
            ->get();

        return response()->json($data);
    }


    // I = ((Ia - Ib) / (Xa - Xb)) * (Xx - Xb) + Ib.
    public static function calculate_ispu($xx, $type)
    {
        // ISPU batas atas dan bawah.
        $ia = 1;
        $ib = 1;

        // Konsentrasi ambien batas atas dan bawah.
        $xa = 1;
        $xb = 1;

        switch ($type) {
            case 'PM2.5':
                if ($xx <= 15.5) {
                    $ia = 50;
                    $ib = $xb = 0;

                    $xa = 15.5;
                } else if ($xx > 15.5 && $xx <= 55.4) {
                    $ia = 100;
                    $ib = 50;

                    $xa = 55.4;
                    $xb = 15.5;
                } else if ($xx > 55.4 && $xx <= 150.4) {
                    $ia = 200;
                    $ib = 100;

                    $xa = 150.4;
                    $xb = 55.4;
                } else if ($xx > 150.4 && $xx <= 250.4) {
                    $ia = 300;
                    $ib = 200;

                    $xa = 250.4;
                    $xb = 150.4;
                } else if ($xx > 250.4 && $xx <= 500) {
                    $ia = 400;
                    $ib = 300;

                    $xa = 500;
                    $xb = 250.4;
                }

                break;

            case 'PM10':
                if ($xx <= 50) {
                    $ia = $xa = 50;
                    $ib = $xb = 0;
                } else if ($xx > 50 && $xx <= 150) {
                    $ia = 100;
                    $ib = $xb = 50;

                    $xa = 150;
                } else if ($xx > 150 && $xx <= 350) {
                    $ia = 200;
                    $ib = 100;

                    $xa = 350;
                    $xb = 150;
                } else if ($xx > 350 && $xx <= 420) {
                    $ia = 300;
                    $ib = 200;

                    $xa = 420;
                    $xb = 350;
                } else if ($xx > 420 && $xx <= 500) {
                    $ia = 400;
                    $ib = 300;

                    $xa = 500;
                    $xb = 420;
                }

                break;

            case 'CO':
                if ($xx <= 4000) {
                    $ia = 50;
                    $ib = $xb = 0;

                    $xa = 4000;
                } else if ($xx > 4000 && $xx <= 8000) {
                    $ia = 100;
                    $ib = 50;

                    $xa = 8000;
                    $xb = 4000;
                } else if ($xx > 8000 && $xx <= 15000) {
                    $ia = 200;
                    $ib = 100;

                    $xa = 15000;
                    $xb = 8000;
                } else if ($xx > 15000 && $xx <= 30000) {
                    $ia = 300;
                    $ib = 200;

                    $xa = 30000;
                    $xb = 15000;
                } else if ($xx > 30000 && $xx <= 45000) {
                    $ia = 400;
                    $ib = 300;

                    $xa = 45000;
                    $xb = 30000;
                }

                break;

            default:
                # code...
                break;
        }

        // Perhitungan ISPU.
        return (($ia - $ib) / ($xa - $xb)) * ($xx - $xb) + $ib;
    }

    public static function categorize_ispu($value)
    {
        if ($value <= 50) {
            return 'Good';
        } else if ($value <= 100) {
            return 'Moderate';
        } else if ($value <= 200) {
            return 'Unhealthy';
        } else if ($value <= 300) {
            return 'Very Unhealthy';
        } else {
            return 'Hazardous';
        }
    }

    public function checkAirQuality(Request $request)
    {
        // Ambil data kualitas udara terbaru dari TelemetryLog
        $latestTelemetryLog = TelemetryLog::latest()->first();

        if ($latestTelemetryLog) {
            // Dapatkan nilai AQI dari TelemetryLog 
            $ispu = $latestTelemetryLog->ispu;
            $category = self::categorize_ispu($ispu);

            $message = '';
            switch ($category) {
                case 'Unhealthy':
                    $message = 'Udara di lokasi Anda tidak sehat.';
                    break;
                case 'Very Unhealthy':
                    $message = 'Udara di lokasi Anda sangat tidak sehat.';
                    break;
                case 'Hazardous':
                    $message = 'Udara di lokasi Anda berbahaya.';
                    break;
            }

            if ($category == 'Unhealthy' || $category == 'Very Unhealthy' || $category == 'Hazardous') {
                $notifications = session('notifications', []);
                $notifications[] = [
                    'message' => $message,
                    'timestamp' => now()->diffForHumans()
                ];

                // Set pesan notifikasi ke session untuk Toastr dan dropdown menu
                Session::flash('toastr', $message);
                Session::put('notifications', $notifications);
            }
        }

        return redirect()->back(); // Redirect ke halaman sebelumnya atau halaman lain
    }
}
