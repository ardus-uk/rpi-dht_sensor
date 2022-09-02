#!/usr/bin/python3

"""Get temperature and humidity from a sensor, using the Raspberry Pi
"""

# DHTsensor.py
# DHT Sensor script for use with cron
# Peter Normington
# 2019-03-02

# The Adafruit_DHT module provides the means to access the sensor
import Adafruit_DHT, datetime
from time import *

# Identify the sensor; we have the DHT22
sensor = Adafruit_DHT.DHT22
# Use GPIO4 for input on Raspberry Pi 4
gpio = 4

readingDateTime = datetime.datetime.now()
readingDate = str(readingDateTime.strftime("%Y-%m-%d"))
readingTime = str(readingDateTime.strftime("%H:%M:%S"))

# Identify file for output
filename = "/home/peter/dht/th_"+readingDate+".csv"

# The read_retry method returns humidity and temperature in that order
hdty,temp = Adafruit_DHT.read_retry(sensor, gpio)

temp_in_range = temp > -20 and temp < 70
humidity_in_range = hdty > 0 and hdty < 100

# Write output as comma-separated values
if (temp_in_range and humidity_in_range):
    f = open(filename, "a")
    f.write(readingDate+",")
    f.write(readingTime+",")
    f.write(str("{:.1f},".format(temp)))
    f.write(str("{:.1f}\n".format(hdty)))
    f.close()