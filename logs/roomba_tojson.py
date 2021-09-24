#!/usr/bin/python3
import sys
import json
import os
import time
import paho.mqtt.client as mqtt
battery = ""
charging = ""
# The callback for when the client receives a CONNACK response from the server.
def on_connect(client, userdata, flags, rc):
    print("Connected...")
    # get roomba data
    client.subscribe([
        ("mcc43/roomba/battery",1),
        ("mcc43/roomba/charging",1)
    ])


# The callback for when a PUBLISH message is received from the server.
def on_message(client, userdata, msg):
    cleantopic = msg.topic.replace("mcc43/roomba/","")
    global battery
    global charging
    print('rrrrrr'+battery + charging)


    if cleantopic == "battery":
        battery = str(msg.payload,'utf-8')
    if cleantopic == "charging":
        charging = str(msg.payload,'utf-8')



    if battery != '' and charging != '':
        print('Writing down data...')
        #######################
        # write down everything
        filename = '/home/pi/www_root/pizero-weather/logs/home_readings.json'
        with open(filename, 'r') as f:
            data = json.load(f)
            data['roomba']['battery'] = battery
            data['roomba']['status'] = charging
            data['roomba']['time'] = time.strftime("%d-%m-%Y %H:%M")

        with open(filename, 'w') as f:
            json.dump(data, f, indent=4)
        #######################
        print('Done! Disconnecting...')
        # close connection
        client.disconnect()
    else :
        print('Waiting more data...')

    print('done loop...')


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("192.168.1.108", 1883, 60)

# Blocking call that processes network traffic, dispatches callbacks and
# handles reconnecting.
# Other loop*() functions are available that give a threaded interface and a
# manual interface.
client.loop_forever()
