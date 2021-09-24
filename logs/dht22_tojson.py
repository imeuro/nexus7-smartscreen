#!/usr/bin/env python

import sys
import Adafruit_DHT
import json
import os
import time
import paho.mqtt.client as mqtt
import paho.mqtt.publish as publish
import paho.mqtt.subscribe as subscribe

sensor = Adafruit_DHT.DHT22
pin = 22

humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)

if humidity is not None and temperature is not None:
    print (round(temperature,2))
    print (round(humidity,2))

    # connect to MQTT channels:
    broker_address="192.168.1.109"

    client = mqtt.Client("PiZero") #create new instance
    client.username_pw_set('meuro', 'Trullalla10')
    client.connect(broker_address) #connect to broker

    #push DHT22 data to MQTT
    # mcc43/dht22/temp_in & mcc43/dht22/humi_in
    sendmsgs = [
        {'topic': "mcc43/dht22/temp_in", 'payload': round(temperature,1) - 2, 'qos':0, 'retain':True},
        {'topic': "mcc43/dht22/humi_in", 'payload': round(humidity,1), 'qos':0, 'retain':True}
    ]
    publish.multiple(sendmsgs,broker_address)

    #######################
    # write down everything
    filename = '/home/pi/www_root/pizero-weather/logs/home_readings.json'
    with open(filename, 'r') as f:
        data = json.load(f)

        data['inside']['temp'] = round(temperature,1) - 2
        data['inside']['humi'] = round(humidity ,1)
        data['inside']['time'] = time.strftime("%d-%m-%Y %H:%M")

    with open(filename, 'w') as f:
        json.dump(data, f, indent=4)
    #######################


else:
    print('Failed to get a reading. Please try again!')
