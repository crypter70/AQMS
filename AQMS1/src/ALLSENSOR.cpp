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

// // init MQ7 device

// #define A_PIN 2
// #define VOLTAGE 5

// #define BME_SCK 13
// #define BME_MISO 12
// #define BME_MOSI 11
// #define BME_CS 10
// #define DHTPIN 4
// #define INDICATOR 38
// #define TX_ZH03B 35
// #define RX_ZH03B 36
// #define SDA_YDESP32 8
// #define SCL_YDESP32 9
// #define DEBUG_ENABLE_BME280 true
// #define DEBUG_ENABLE_ZH03B true
// #define DEBUG_ENABLE_DHT22 true
// #define DEBUG_ENABLE_MQ7 true
// #define DEBUG_ENABLE_MQ7_ANALOG true
// #define DEBUG_ENABLE_BLINKING false

// // Calibration factor for the sensor
// #define TEMP_COMPENSATION -1.4
// #define SEALEVELPRESSURE_HPA (1010.7)

// SimpleKalmanFilter simpleKalmanFilter(2, 2, 0.01);

// DHTesp dht;
// Adafruit_BME280 bme; // I2C
// Adafruit_ADS1115 ads;
// HardwareSerial ZHSerial(1); // RX, TX
// SD_ZH03B ZH03B(ZHSerial);
// MQ7 mq7(A_PIN, VOLTAGE);

// // Adafruit_BME280 bme(BME_CS); // hardware SPI
// // Adafruit_BME280 bme(BME_CS, BME_MOSI, BME_MISO, BME_SCK); // software SPI

// const float multiplier = 0.1875F;
// unsigned long delayTime;
// ComfortState cf;
// unsigned long lastime = 0;
// bool stateLed = false;

// bool getTemperature();
// bool initTemp();

// // Callback methods prototypes
// void cReadZH03B();
// void cReadBME280();
// void cReadDHT22();
// void cReadAnalogMQ7();
// void cReadMQ7();
// void cBlinking();

// // Tasks
// Task tReadZH03B(5000, TASK_FOREVER, &cReadZH03B);
// Task tReadBME280(5000, TASK_FOREVER, &cReadBME280);
// Task tReadDHT22(2000, TASK_FOREVER, &cReadDHT22);
// Task tReadAnalogMQ7(1000, TASK_FOREVER, &cReadAnalogMQ7);
// Task tReadMQ7(5000, TASK_FOREVER, &cReadMQ7);
// Task tBlinking(1000, TASK_FOREVER, &cBlinking);

// Scheduler runner;

// void setup()
// {
//     // initialize UART communication
//     Serial.begin(115200);
//     ZHSerial.begin(9600, SERIAL_8N1, RX_ZH03B, TX_ZH03B);

//     while (!Serial)
//         ; // time to get serial running

//     // DEBUG_PRINTLN("ALL SENSOR TEST");

//     // initialize I2C communication
//     Wire.begin(SDA_YDESP32, SCL_YDESP32);

//     // setup variables
//     unsigned statusBME280;

//     // Initialize sensor
//     ZH03B.setMode(SD_ZH03B::QA_MODE);      // Set the mode to Query and Answer Mode (ZH03B)
//     statusBME280 = bme.begin(0x76, &Wire); // Connect to baromeric sensor (BME280) with I2C address 0x76
//     initTemp();                            // Initialize temperature and humidity sensor (DHT22)

//     // Initialize ADC
//     ads.begin();

//     // Initialize LED Indicator
//     pinMode(INDICATOR, OUTPUT);

//     // Check if sensor BME280 is connected
//     if (!statusBME280)
//     {
//         DEBUG_PRINTLN("Could not find a valid BME280 sensor, check wiring, address, sensor ID!");
//         DEBUG_PRINT("SensorID was: 0x");
//         // DEBUG_PRINTLN(bme.sensorID(), 16);
//         DEBUG_PRINT("        ID of 0xFF probably means a bad address, a BMP 180 or BMP 085\n");
//         DEBUG_PRINT("   ID of 0x56-0x58 represents a BMP 280,\n");
//         DEBUG_PRINT("        ID of 0x60 represents a BME 280.\n");
//         DEBUG_PRINT("        ID of 0x61 represents a BME 680.\n");
//     }
//     else
//     {
//         bme.setTemperatureCompensation(TEMP_COMPENSATION); // Set temperature compensation
//     }

//     delayTime = 1000;

//     runner.init();

//     // Add tasks to scheduler
//     runner.addTask(tReadZH03B);
//     runner.addTask(tReadBME280);
//     runner.addTask(tReadDHT22);
//     runner.addTask(tReadAnalogMQ7);
//     runner.addTask(tReadMQ7);
//     runner.addTask(tBlinking);

//     // Enable tasks
//     tReadZH03B.enable();
//     tReadBME280.enable();
//     tReadDHT22.enable();
//     tReadAnalogMQ7.enable();
//     tReadMQ7.enable();
//     tBlinking.enable();
// }

// void loop()
// {
//     runner.execute();
// }

// bool initTemp()
// {
//     byte resultValue = 0;
//     // Initialize temperature sensor
//     dht.setup(DHTPIN, DHTesp::DHT22);
//     // DEBUG_PRINTLN("DHT initiated");

//     if (dht.getStatus() != 0)
//     {
//         DEBUG_PRINTLN("DHT error status: " + String(dht.getStatusString()));
//         return false;
//     }

//     return true;
// }

// void cReadZH03B()
// {
//     if (ZH03B.readData())
//     {
// // Serial.print(ZH03B.getMode() == SD_ZH03B::IU_MODE ? "IU:" : "Q&A:");
// #if DEBUG_ENABLE_ZH03B == true
//         DEBUG_PRINTF("[ZH03B] PM1.0: %d ug/m3\n", ZH03B.getPM1_0());
//         DEBUG_PRINTF("[ZH03B] PM2.5: %d ug/m3\n", ZH03B.getPM2_5());
//         DEBUG_PRINTF("[ZH03B] PM10: %d ug/m3\n", ZH03B.getPM10_0());
// #endif
//     }
//     else
//     {
// #if DEBUG_ENABLE_ZH03B == true
//         DEBUG_PRINTLN("ZH03B Error reading stream or Check Sum Error");
// #endif
//     }
// }

// void cReadBME280()
// {
//     float temperature = bme.readTemperature();
//     float pressure = bme.readPressure() / 100.0F;
//     float altitude = bme.readAltitude(SEALEVELPRESSURE_HPA);
//     float humidity = bme.readHumidity();

// #if DEBUG_ENABLE_BME280 == true
//     DEBUG_PRINT("[BME280] Temperature = ");
//     DEBUG_PRINT(temperature - 9.5);
//     DEBUG_PRINTLN(" °C");

//     DEBUG_PRINT("[BME280] Pressure = ");
//     DEBUG_PRINT(pressure);
//     DEBUG_PRINTLN(" hPa");

//     DEBUG_PRINT("[BME280] Approx. Altitude = ");
//     DEBUG_PRINT(altitude);
//     DEBUG_PRINTLN(" m");

//     DEBUG_PRINT("[BME280] Humidity = ");
//     DEBUG_PRINT(humidity);
//     DEBUG_PRINTLN(" %");
// #endif
// }

// void cReadDHT22()
// {
//     // Reading temperature for humidity takes about 250 milliseconds!
//     // Sensor readings may also be up to 2 seconds 'old' (it's a very slow sensor)
//     TempAndHumidity newValues = dht.getTempAndHumidity();
//     newValues.temperature = newValues.temperature + -6.1;
//     // Check if any reads failed and exit early (to try again).

//     if (dht.getStatus() != 0)
//     {
//         DEBUG_PRINTLN("DHT22 error: " + String(dht.getStatusString()));
//     }
//     else
//     {
//         float heatIndex = dht.computeHeatIndex(newValues.temperature, newValues.humidity);
//         float dewPoint = dht.computeDewPoint(newValues.temperature, newValues.humidity);
//         float cr = dht.getComfortRatio(cf, newValues.temperature, newValues.humidity);

//         String comfortStatus;
//         switch (cf)
//         {
//         case Comfort_OK:
//             comfortStatus = "Comfort_OK";
//             break;
//         case Comfort_TooHot:
//             comfortStatus = "Comfort_TooHot";
//             break;
//         case Comfort_TooCold:
//             comfortStatus = "Comfort_TooCold";
//             break;
//         case Comfort_TooDry:
//             comfortStatus = "Comfort_TooDry";
//             break;
//         case Comfort_TooHumid:
//             comfortStatus = "Comfort_TooHumid";
//             break;
//         case Comfort_HotAndHumid:
//             comfortStatus = "Comfort_HotAndHumid";
//             break;
//         case Comfort_HotAndDry:
//             comfortStatus = "Comfort_HotAndDry";
//             break;
//         case Comfort_ColdAndHumid:
//             comfortStatus = "Comfort_ColdAndHumid";
//             break;
//         case Comfort_ColdAndDry:
//             comfortStatus = "Comfort_ColdAndDry";
//             break;
//         default:
//             comfortStatus = "Unknown:";
//             break;
//         };

// #if DEBUG_ENABLE_DHT22 == true
//         DEBUG_PRINTLN("[DHT22] T: " + String(newValues.temperature) + " °C");
//         DEBUG_PRINTLN("[DHT22] H: " + String(newValues.humidity) + " %");
//         DEBUG_PRINTLN("[DHT22] HI: " + String(heatIndex) + " °C");
//         DEBUG_PRINTLN("[DHT22] DP: " + String(dewPoint) + " °C");
//         DEBUG_PRINTLN("[DHT22] CR: " + String(cr) + " %");
//         DEBUG_PRINTLN("[DHT22] Comfort: " + comfortStatus);
// #endif
//     }
// }

// void cReadAnalogMQ7()
// {
//     int16_t adc0;
//     adc0 = ads.readADC_SingleEnded(0);
//     float Voltage = (adc0 * multiplier) / 1000;

//     int16_t filteredValue = simpleKalmanFilter.updateEstimate(adc0);

//     float FilteredVoltage = (filteredValue * multiplier) / 1000;

// #if DEBUG_ENABLE_MQ7 == true
//     DEBUG_PRINTLN("[MQ7] ADC0: " + String(adc0));
//     DEBUG_PRINTLN("[MQ7] Filtered: " + String(filteredValue));
//     DEBUG_PRINTLN("[MQ7] Voltage: " + String(Voltage) + " V");
//     DEBUG_PRINTLN("[MQ7] Filtered Voltage: " + String(FilteredVoltage) + " V");
// #endif

// #if DEBUG_ENABLE_MQ7_ANALOG == true
//     DEBUG_PRINT(adc0);
//     DEBUG_PRINT("  ");
//     DEBUG_PRINT(filteredValue);
//     DEBUG_PRINT("  ");
//     DEBUG_PRINTP(Voltage, 2);
//     DEBUG_PRINT("  ");
//     DEBUG_PRINTP(FilteredVoltage, 2);
//     DEBUG_PRINTLN();
// #endif
// }

// void cReadMQ7()
// {
//     // TODO: Implement MQ7 sensor reading
    
// }

// void cBlinking()
// {
//     if (stateLed)
//     {
//         digitalWrite(INDICATOR, LOW);
//     }
//     else
//     {
//         digitalWrite(INDICATOR, HIGH);
//     }
//     stateLed = !stateLed;
// }
