// #include <Arduino.h>
// #include <Wire.h>
// #include <Adafruit_ADS1X15.h>
// #include <SPI.h>
// #include "MQ7.h"

// Adafruit_ADS1115 ads;
// const float multiplier = 0.1875F;

// unsigned long lastime = 0;
// bool stateLed = false;

// void setup()
// {
//     Serial.begin(115200);
//     Serial.println("Hello World");
//     pinMode(38, OUTPUT);

//     mq7.calibrate();
//     Wire.begin(8, 9);

//     ads.begin();
// }

// void loop()
// {
//     int16_t adc0;

//     adc0 = ads.readADC_SingleEnded(0);
//     ads.

//     float Voltage = (adc0 * multiplier) / 1000;

//     // Serial.print("AIN0: ");
//     Serial.print(adc0);
//     Serial.print("  ");
//     Serial.print(Voltage, 7);
//     // Serial.print("V");
//     Serial.println();

//     if (millis() - lastime > 1000)
//     {
//         if (stateLed)
//         {
//             digitalWrite(38, LOW);
//         }
//         else
//         {
//             digitalWrite(38, HIGH);
//         }
//         stateLed = !stateLed;
//         lastime = millis();
//     }

//     delay(10);
// }
