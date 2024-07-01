<?php

namespace App\Http\Controllers;

use App\Models\TelemetryLog;
use Illuminate\Http\Request;

use Carbon\Carbon;


class ISPUController extends Controller
{
    public static function get_ispu($device)
    {
        $today = Carbon::now();
        $yesterday = Carbon::now()->subDay();

        // Ambil data sensor selama 24 jam terakhir untuk id_device tertentu
        /* $data = TelemetryLog::where('id_device', $device)
            ->whereBetween('time_captured', [$yesterday, $today])
            ->get(); */

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


        // Dapatkan kategori notifikasi
        /* $notifications = $this->getNotifications($ispu['pm25'], 'PM2.5');
        $notifications = array_merge($notifications, $this->getNotifications($ispu['pm10'], 'PM10'));
        $notifications = array_merge($notifications, $this->getNotifications($ispu['co'], 'CO')); */

        /* return response()->json([
            'pm2_5' => $ispuPM25,
            'pm10' => $ispuPM10,
            'co' => $ispuCO,
            'notifications' => $notifications,
        ]); */

        return $ispu;
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

        switch ($type)
        {
            case 'PM2.5':
                if ($xx <= 15.5)
                {
                    $ia = 50;
                    $ib = $xb = 1;

                    $xa = 15.5;
                }
                else if ($xx > 15.5 && $xx <= 55.4)
                {
                    $ia = 100;
                    $ib = 51;
                    
                    $xa = 55.4;
                    $xb = 15.6;
                }
                else if ($xx > 55.4 && $xx <= 150.4)
                {
                    $ia = 200;
                    $ib = 101;

                    $xa = 150.4;
                    $xb = 55.5;
                }
                else if ($xx > 150.4 && $xx <= 250.4)
                {
                    $ia = 300;
                    $ib = 201;

                    $xa = 250.4;
                    $xb = 150.5;
                }
                else if ($xx > 250.4 && $xx <= 500)
                {
                    $ia = 400;
                    $ib = 301;

                    $xa = 500;
                    $xb = 250.5;
                }

                break;
            
            case 'PM10':
                if ($xx <= 50)
                {
                    $ia = $xa = 50;
                    $ib = $xb = 1;
                }
                else if ($xx > 50 && $xx <= 150)
                {
                    $ia = 100;
                    $ib = $xb = 51;
                    
                    $xa = 150;
                }
                else if ($xx > 150 && $xx <= 350)
                {
                    $ia = 200;
                    $ib = 101;

                    $xa = 350;
                    $xb = 151;
                }
                else if ($xx > 350 && $xx <= 420)
                {
                    $ia = 300;
                    $ib = 201;

                    $xa = 420;
                    $xb = 351;
                }
                else if ($xx > 420 && $xx <= 500)
                {
                    $ia = 400;
                    $ib = 301;

                    $xa = 500;
                    $xb = 421;
                }

                break;
            
            case 'CO':
                if ($xx <= 4000)
                {
                    $ia = 50;
                    $ib = $xb = 1;

                    $xa = 4000;
                }
                else if ($xx > 4000 && $xx <= 8000)
                {
                    $ia = 100;
                    $ib = 51;
                    
                    $xa = 8000;
                    $xb = 4001;
                }
                else if ($xx > 8000 && $xx <= 15000)
                {
                    $ia = 200;
                    $ib = 101;

                    $xa = 15000;
                    $xb = 8001;
                }
                else if ($xx > 15000 && $xx <= 30000)
                {
                    $ia = 300;
                    $ib = 201;

                    $xa = 30000;
                    $xb = 15001;
                }
                else if ($xx > 30000 && $xx <= 45000)
                {
                    $ia = 400;
                    $ib = 301;

                    $xa = 45000;
                    $xb = 30001;
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
        if ($value <= 50)
        {
            return 'Good';
        }
        else if ($value <= 100)
        {
            return 'Moderate';
        }
        else if ($value <= 200)
        {
            return 'Unhealthy';
        }
        else if ($value <= 300)
        {
            return 'Very Unhealthy';
        }
        else
        {
            return 'Hazardous';
        }
    }
}
