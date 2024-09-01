// /*********
//   Rui Santos
//   Complete project details at https://randomnerdtutorials.com
// *********/

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
// #include <Wire.h>

// void setup()
// {
//     Wire.begin(8, 9);
//     Serial.begin(115200);
//     Serial.println("\nI2C Scanner");
// }

// void loop()
// {
//     byte error, address;
//     int nDevices;
//     Serial.println("Scanning...");
//     nDevices = 0;
//     for (address = 1; address < 127; address++)
//     {
//         Wire.beginTransmission(address);
//         error = Wire.endTransmission();
//         if (error == 0)
//         {
//             Serial.print("I2C device found at address 0x");
//             if (address < 16)
//             {
//                 Serial.print("0");
//             }
//             Serial.println(address, HEX);
//             nDevices++;
//         }
//         else if (error == 4)
//         {
//             Serial.print("Unknow error at address 0x");
//             if (address < 16)
//             {
//                 Serial.print("0");
//             }
//             Serial.println(address, HEX);
//         }
//     }
//     if (nDevices == 0)
//     {
//         Serial.println("No I2C devices found\n");
//     }
//     else
//     {
//         Serial.println("done\n");
//     }
//     delay(5000);
// }