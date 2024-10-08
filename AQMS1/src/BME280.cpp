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

// /***************************************************************************
//   This is a library for the BME280 humidity, temperature & pressure sensor

//   Designed specifically to work with the Adafruit BME280 Breakout
//   ----> http://www.adafruit.com/products/2650

//   These sensors use I2C or SPI to communicate, 2 or 4 pins are required
//   to interface. The device's I2C address is either 0x76 or 0x77.

//   Adafruit invests time and resources providing this open source code,
//   please support Adafruit andopen-source hardware by purchasing products
//   from Adafruit!

//   Written by Limor Fried & Kevin Townsend for Adafruit Industries.
//   BSD license, all text above must be included in any redistribution
//   See the LICENSE file for details.
//  ***************************************************************************/

// #define BME_SCK 13
// #define BME_MISO 12
// #define BME_MOSI 11
// #define BME_CS 10

// #define SEALEVELPRESSURE_HPA (1010.7)

// Adafruit_BME280 bme; // I2C
// // Adafruit_BME280 bme(BME_CS); // hardware SPI
// // Adafruit_BME280 bme(BME_CS, BME_MOSI, BME_MISO, BME_SCK); // software SPI

// unsigned long delayTime;

// void printValues();


// void setup()
// {
//     Serial.begin(115200);
//     while (!Serial)
//         ; // time to get serial running
//     Serial.println(F("BME280 test"));

//     unsigned status;
//     Wire.begin(8, 9);
//     // default settings
//     status = bme.begin(0x76, &Wire);
//     bme.setTemperatureCompensation(-1.4);
//     // bme.seaLevelForAltitude
//     // bme.setTemperatureCompensation(-4.6);
//     // You can also pass in a Wire library object like &Wire2
//     // status = bme.begin(0x76, &Wire2)
//     if (!status)
//     {
//         Serial.println("Could not find a valid BME280 sensor, check wiring, address, sensor ID!");
//         Serial.print("SensorID was: 0x");
//         Serial.println(bme.sensorID(), 16);
//         Serial.print("        ID of 0xFF probably means a bad address, a BMP 180 or BMP 085\n");
//         Serial.print("   ID of 0x56-0x58 represents a BMP 280,\n");
//         Serial.print("        ID of 0x60 represents a BME 280.\n");
//         Serial.print("        ID of 0x61 represents a BME 680.\n");
//         while (1)
//             delay(10);
//     }

//     Serial.println("-- Default Test --");
//     delayTime = 1000;

//     Serial.println();
// }

// void loop()
// {
//     printValues();
//     delay(delayTime);
// }

// void printValues()
// {
//     Serial.print("Temperature = ");
//     Serial.print(bme.readTemperature());
//     Serial.println(" °C");

//     Serial.print("Pressure = ");

//     Serial.print(bme.readPressure() / 100.0F);
//     Serial.println(" hPa");

//     Serial.print("Approx. Altitude = ");
//     Serial.print(bme.readAltitude(SEALEVELPRESSURE_HPA));
//     Serial.println(" m");

//     Serial.print("Humidity = ");
//     Serial.print(bme.readHumidity());
//     Serial.println(" %");

//     Serial.println();
// }
