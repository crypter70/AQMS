<?php

namespace App\Console\Commands;

use App\Models\TelemetryLog;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MQTTCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('AQMS_UPI/in', function (string $topic, string $message) {
            // echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
            echo $message . "\n";
            
            // Initialize.
            $request = json_decode($message, true);
            $insert['id_device'] = $request['ID'];
            $insert['time_captured'] = $request['dateTime']['date'] . " " . $request['dateTime']['time'];
        
            // BME280 sensor.
            $insert['bme280_temperature'] = $request['sensor']['BME280']['Temperature'];
            $insert['bme280_pressure'] = $request['sensor']['BME280']['Pressure'];
            $insert['bme280_altitude'] = $request['sensor']['BME280']['Altitude'];
            $insert['bme280_humidity'] = $request['sensor']['BME280']['Humidity'];
            
            // DHT22 sensor.
            $insert['dht22_temperature'] = $request['sensor']['DHT22']['Temperature'];
            $insert['dht22_humidity'] = $request['sensor']['DHT22']['Humidity'];
            $insert['dht22_heatindex'] = $request['sensor']['DHT22']['HeatIndex'];
            $insert['dht22_dewpoint'] = $request['sensor']['DHT22']['DewPoint'];
            $insert['dht22_comfort_ratio'] = $request['sensor']['DHT22']['ComfortRatio'];
            $insert['dht22_comfort_status'] = $request['sensor']['DHT22']['ComfortStatus'];

            // ZH03B sensor.
            $insert['pm_1_0_level'] = $request['sensor']['ZH03B']['PM1.0'];
            $insert['pm_2_5_level'] = $request['sensor']['ZH03B']['PM2.5'];
            $insert['pm_10_0_level'] = $request['sensor']['ZH03B']['PM10.0'];

            // MQ7 sensor.
            $insert['co_level'] = $request['sensor']['MQ7']['PPM'];
            echo $insert['time_captured'] . "\n";

            // Insert data to database.
            TelemetryLog::create($insert);
        }, 1);

        $mqtt->loop(true);
    }
}
