// #include "DHTesp.h" // Click here to get the library: http://librarymanager/All#DHTesp
// #include <Ticker.h>
// #include <Arduino.h>
// #include <Wire.h>
// #include <Adafruit_ADS1X15.h>
// #include <SPI.h>
// #include <HardwareSerial.h>
// #include <Adafruit_Sensor.h>
// #include <Adafruit_BME280.h>
// #include <SD_ZH03B.h>
// #include <dev_config.h>
// #include <TaskScheduler.h>
// #include <SimpleKalmanFilter.h>
// #include "MQ7.h"

// #ifndef ESP32
// #pragma message(THIS EXAMPLE IS FOR ESP32 ONLY !)
// #error Select ESP32 board.
// #endif

// /**************************************************************/
// /* Example how to read DHT sensors from an ESP32 using multi- */
// /* tasking.                                                   */
// /* This example depends on the Ticker library to wake up      */
// /* the task every 20 seconds                                  */
// /**************************************************************/

// DHTesp dht;

// void tempTask(void *pvParameters);
// bool getTemperature();
// void triggerGetTemp();

// /** Task handle for the light value read task */
// TaskHandle_t tempTaskHandle = NULL;
// /** Ticker for temperature reading */
// Ticker tempTicker;
// /** Comfort profile */
// ComfortState cf;
// /** Flag if task should run */
// bool tasksEnabled = false;
// /** Pin number for DHT11 data pin */
// int dhtPin = 4;

// /**
//  * initTemp
//  * Setup DHT library
//  * Setup task and timer for repeated measurement
//  * @return bool
//  *    true if task and timer are started
//  *    false if task or timer couldn't be started
//  */
// bool initTemp()
// {
//     byte resultValue = 0;
//     // Initialize temperature sensor
//     dht.setup(dhtPin, DHTesp::DHT22);
//     Serial.println("DHT initiated");

//     if (dht.getStatus() != 0)
//     {
//         Serial.println("DHT error status: " + String(dht.getStatusString()));
//         return false;
//     }
    
//     return true;
// }


// /**
//  * getTemperature
//  * Reads temperature from DHT11 sensor
//  * @return bool
//  *    true if temperature could be aquired
//  *    false if aquisition failed
//  */
// bool getTemperature()
// {
//     // Reading temperature for humidity takes about 250 milliseconds!
//     // Sensor readings may also be up to 2 seconds 'old' (it's a very slow sensor)
//     TempAndHumidity newValues = dht.getTempAndHumidity();
//     // Check if any reads failed and exit early (to try again).
//     if (dht.getStatus() != 0)
//     {
//         Serial.println("DHT11 error status: " + String(dht.getStatusString()));
//         return false;
//     }

//     float heatIndex = dht.computeHeatIndex(newValues.temperature, newValues.humidity);
//     float dewPoint = dht.computeDewPoint(newValues.temperature, newValues.humidity);
//     float cr = dht.getComfortRatio(cf, newValues.temperature, newValues.humidity);

//     String comfortStatus;
//     switch (cf)
//     {
//     case Comfort_OK:
//         comfortStatus = "Comfort_OK";
//         break;
//     case Comfort_TooHot:
//         comfortStatus = "Comfort_TooHot";
//         break;
//     case Comfort_TooCold:
//         comfortStatus = "Comfort_TooCold";
//         break;
//     case Comfort_TooDry:
//         comfortStatus = "Comfort_TooDry";
//         break;
//     case Comfort_TooHumid:
//         comfortStatus = "Comfort_TooHumid";
//         break;
//     case Comfort_HotAndHumid:
//         comfortStatus = "Comfort_HotAndHumid";
//         break;
//     case Comfort_HotAndDry:
//         comfortStatus = "Comfort_HotAndDry";
//         break;
//     case Comfort_ColdAndHumid:
//         comfortStatus = "Comfort_ColdAndHumid";
//         break;
//     case Comfort_ColdAndDry:
//         comfortStatus = "Comfort_ColdAndDry";
//         break;
//     default:
//         comfortStatus = "Unknown:";
//         break;
//     };

//     Serial.println(" T:" + String(newValues.temperature) + " H:" + String(newValues.humidity) + " I:" + String(heatIndex) + " D:" + String(dewPoint) + " " + comfortStatus);
//     return true;
// }

// void setup()
// {
//     Serial.begin(115200);
//     Serial.println();
//     Serial.println("DHT ESP32 example with tasks");
//     initTemp();
//     // Signal end of setup() to tasks
// }

// void loop()
// {
//     getTemperature();
//     delay(2000);
//     yield();
// }
