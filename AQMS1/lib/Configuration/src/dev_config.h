#include <Arduino.h>

#define DEVICE_FIRMWARE_VERSION "0.5.5"
#define DEVICE_NUMBER 4
#define DEBUG_PROGRAM true

#define USE_PASSWORD_MQTT false
// #define MQTT_SERVER "103.226.138.7"
#define MQTT_USER "-"
#define MQTT_PASSWORD "-"
#define MQTT_TOPIC_PUBLISH "wsn"
#define OTA_SERVER MQTT_SERVER

#if DEVICE_NUMBER == 1
#define DEVICE_ID "WSN000001"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN1_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 2
#define DEVICE_ID "WSN000002"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN2_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 3
#define DEVICE_ID "WSN000003"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN3_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 4
#define DEVICE_ID "WSN000004"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN4_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 5
#define DEVICE_ID "WSN000005"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN5_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 6
#define DEVICE_ID "WSN000006"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN6_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 7
#define DEVICE_ID "WSN000007"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN7_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 8
#define DEVICE_ID "WSN000008"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN8_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 9
#define DEVICE_ID "WSN000009"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN9_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 10
#define DEVICE_ID "WSN000010"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN10_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 11
#define DEVICE_ID "WSN000011"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN11_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 12
#define DEVICE_ID "WSN000012"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN12_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 13
#define DEVICE_ID "WSN000013"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN13_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 14
#define DEVICE_ID "WSN000014"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN14_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 15
#define DEVICE_ID "WSN000015"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN15_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 16
#define DEVICE_ID "WSN000016"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN16_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 17
#define DEVICE_ID "WSN000017"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN17_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 18
#define DEVICE_ID "WSN000018"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN18_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 19
#define DEVICE_ID "WSN000019"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN19_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#elif DEVICE_NUMBER == 20
#define DEVICE_ID "WSN000020"
#define WIFI_AP_NAME DEVICE_ID
#define WIFI_AP_PASSWORD "WSN20_config"
// Calibration
#define INTERNAL_RESISTANCE 0.31
#define MILIVOL_INA219 0
#define SENSOR_SAMPLING_AND_SEND_TIME 1250 // ms
#define MQTT_LOOP_TIME 400                 // ms
#define DEGREE_PT100 0
#endif

#define MQTT_ID DEVICE_ID

#define WIFI_SET_AUTOCONNECT 0
#define WIFI_SET_ONDEMAND 1

#if DEBUG_PROGRAM == true
#define DEBUG_PRINT(x) Serial.print(x)
#define DEBUG_PRINTP(x, y) Serial.print(x, y)
#define DEBUG_PRINTLN(x) Serial.println(x)
#define DEBUG_PRINTF(x, y) Serial.printf(x, y)
#else
#define DEBUG_PRINT(x)
#define DEBUG_PRINTLN(x)
#define DEBUG_PRINTF(x, y)
#endif
