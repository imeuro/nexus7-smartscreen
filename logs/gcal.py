# install this stuff:
# pip3 install --upgrade google-auth-oauthlib
# pip3 install python-dateutil

from __future__ import print_function
import datetime
from dateutil import parser
import os.path
from googleapiclient.discovery import build
from google_auth_oauthlib.flow import InstalledAppFlow
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials

# If modifying these scopes, delete the file token.json.
SCOPES = ['https://www.googleapis.com/auth/calendar.readonly']
WDIR = '/home/pi/www_root/pizero-weather/logs/'

def main():
    """Shows basic usage of the Google Calendar API.
    Prints the start and name of the next 10 events on the user's calendar.
    """
    creds = None
    # The file token.json stores the user's access and refresh tokens, and is
    # created automatically when the authorization flow completes for the first
    # time.
    if os.path.exists(WDIR + 'token.json'):
        creds = Credentials.from_authorized_user_file(WDIR + 'token.json', SCOPES)

    # If there are no (valid) credentials available, let the user log in.
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow = InstalledAppFlow.from_client_secrets_file(
               WDIR + 'credentials.json', SCOPES)
            creds = flow.run_local_server(port=8080)
        # Save the credentials for the next run
        with open(WDIR + 'token.json', 'w') as token:
            token.write(creds.to_json())

    service = build('calendar', 'v3', credentials=creds)

    # Call the Calendar API
    now = datetime.datetime.utcnow().isoformat() + 'Z' # 'Z' indicates UTC time
    #print('Getting the upcoming 5 events')
    events_result = service.events().list(
        calendarId='gtarnu64qd4r4tvvi8lh5bssc8@group.calendar.google.com', 
        timeMin=now,
        maxResults=4,
        singleEvents=True,
        orderBy='startTime').execute()
    events = events_result.get('items', [])

    f = open(WDIR + 'gcal.php', 'w')
    html_template = ''

    if not events:
        print('No upcoming events found.')
    for event in events:
        evstart = event['start']
        evtime = ''
        if 'dateTime' in evstart:
            evdate = parser.parse(evstart['dateTime'])
            evstart = evdate.strftime("%-d %b")
            evtime = evdate.strftime("[%H:%M] ")
        else:
            evstart = parser.parse(evstart['date'])
            evstart = evstart.strftime("%-d %b")

        print(evtime, event['summary'], evstart)

        html_template += "<li>" + evtime + event['summary'] + "<span class='date'>" + evstart + "</span></li>\n"


    f.write(html_template)
    f.close()

if __name__ == '__main__':
    main()
