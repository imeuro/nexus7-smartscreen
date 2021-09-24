# Nexus7-smartscreen
Repurpose your 1st gen Asus Nexus 7 (2012) tablet as a Smart Display for your living room

![1st gen Nexus 7 on duty!](https://user-images.githubusercontent.com/7288731/134741004-43ca0731-3f24-4502-8b92-6f8197e7ff33.jpg)

## Hardware involved
- Asus Nexus 7 1st gen (2012) bought from ebay
- a cheap wish.com [tablet stand](https://www.wish.com/search/tablet%20stand%20aluminium/product/5d833858ece9053fb57f89fa) mimicking the iMac shape.
- (optional) 2x aqara [temperature+humidity sensors](https://it.aliexpress.com/item/1005003263877306.html) 
- (optional) [Zigbee CC2531](https://www.ebay.it/itm/323847138177) usb receiver

## Apps involved:
- [fully kiosk browser](https://play.google.com/store/apps/details?id=de.ozerov.fully)
- [AutoStart - No root](https://play.google.com/store/apps/details?id=com.autostart)
- this code/web app, hosted on a local LAMP server (raspberry Pi in my case) (+ crontabs for data polling)
- (optional) [Mosquitto MQTT](https://github.com/eclipse/mosquitto) broker to read any sensor data
- (optional) [Zigbee2MQTT](https://www.zigbee2mqtt.io/) Aqara proprietary protocol to mqtt protocol converter
- 
## TODO:
- find a way to keep the battery between 80-60% ideally to preserve its life
- maybe a swiper to add new pages (news tv channel, detailed meteo with rain radar ...)
- ...
