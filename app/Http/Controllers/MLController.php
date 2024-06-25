<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredictDataRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MLController extends Controller
{
    public function get()
    {
        $response = Http::get(env('ML_API', '127.0.0.1:6000') . '/');
        $posts = $response->json();
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
    }
}
