<?php
/*****************
 *  CREDENTIALS:
******************/



////	Darksky API weather forecasts: 
////	https://darksky.net/dev/
////	sign up and paste your appid here


// *** attention! ***
// I just discovered darksky is shutting down and not
// accepting new memberships, will shut down services on Q4 2022
 
// see: https://blog.darksky.net/dark-sky-has-a-new-home/
// for depressing news

$city="INSERT_LAT,LONG_HERE";
$appid="INSERT_YOUR_APP_ID_HERE";



////	Google calendar integration: 
////	https://developers.google.com/calendar/api/quickstart/python
////	as per GOOGLE standards, documentation is badly written, scarse and sparse

////	but basicaly:
////	1. create a new project on google cloud API 
////	(see: https://developers.google.com/workspace/guides/create-project)
////	2. download and copy "credentials.json" file in "./logs" folder of this project
////	3. edit ./logs/gcal.py and populate WDIR and CALID variables
////	where WDIR = the absolute path of the folder containing the credentials.json file
////	and CALID the id of the google calendar you want to import events
////	https://docs.simplecalendar.io/find-google-calendar-id/

?>