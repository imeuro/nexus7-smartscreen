#!/usr/bin/python3
import sys
import json
import os
import time
import paho.mqtt.client as mqtt

# The callback for when the client receives a CONNACK response from the server.
def on_connect(client, userdata, flags, rc):
    print("Connected...")
    # get roomba data
    client.subscribe([
        ("mcc43/aqara_inside",0),
        ("mcc43/aqara_outside",0),
        ("mcc43/aqara_giorgia",0),
        ("mcc43/Nexie",0),
    ])


# The callback for when a PUBLISH message is received from the server.
def on_message(client, userdata, msg):

    print(msg.topic)
    print(str(msg.payload,'utf8'))
    cleantopic=msg.topic.replace('mcc43/','')

    print('Writing down data...')
    #######################
    # write down everything
    filename="/home/pi/www_root/pizero-weather/logs/home_readings.json"
    #filename="/media/meuro/essedi/www_root/pizero-weather/logs/home_readings.json"
    jsonFile = open(filename, 'r')
    data = json.load(jsonFile)

    jsonFile.close()

    data[cleantopic] = eval(msg.payload)
    data[cleantopic]['time'] = time.strftime("%d-%m-%Y %H:%M")

    #print('Still writing data...')
    #print(data)

    jsonFile = open(filename, "w+")
    json.dump(data, jsonFile, indent=4)
    jsonFile.close()

    #######################
    print('Done! Disconnecting...')
    # close connection
    client.disconnect()

    #print('done loop...')


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect("meuro.dev", 1883, 60)

# Blocking call that processes network traffic, dispatches callbacks and
# handles reconnecting.
# Other loop*() functions are available that give a threaded interface and a
# manual interface.
client.loop_forever()
