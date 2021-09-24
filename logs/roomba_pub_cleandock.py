#!/usr/bin/python3
import sys
import paho.mqtt.publish as publish

command=sys.argv[1]
print('sending command: "'+command+'"')
publish.single("mcc43/roomba/commands", command, hostname="192.168.1.108")
