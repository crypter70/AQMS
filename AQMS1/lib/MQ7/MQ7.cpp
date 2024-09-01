/*
	MQ7.cpp
	Created by Fergus Baker
	22 August 2020
	Released into the public domain.
*/

#include "MQ7.h"
#include "Arduino.h"

float MQ7::readPpm(float voltageInput)
{
	return (float)_COEF_A0 * pow(readRs(voltageInput) / R0, _COEF_A1);
}

float MQ7::readRs(float voltageInput)
{
	return _LOAD_RES * readRsRL(voltageInput);
}

float MQ7::readRsRL(float voltageInput)
{
	float voltage = voltageInput;

	return (v_in - voltage) / voltage;
}

float MQ7::convertVoltage(int voltage)
{
	// ATD conversion
	return (float)voltage * (v_in / 1023.0);
}

void MQ7::calibrate(float voltageInput)
{
#ifndef _R0 // if no hardcoded R0 value

	delay(1000);
	R0 = readRs(voltageInput) / _CALIBRATION_CONSTANT;

#endif // end
}

float MQ7::getR0()
{
	return R0;
}
