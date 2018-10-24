<?php
date_default_timezone_set('America/Denver');
$timeZone = "America/Denver";
$timestamp = date('Ymd\THis\Z');
$title = "It is for testing";
$location = "GMT";
$start_date = "20150329T163000";
$end_date = "20150329T173000"; 

$CAL = <<<END
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//LokalMotion//LokalMotion Events v1.0//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:LokalMotion Events
X-MS-OLK-FORCEINSPECTOROPEN:TRUE
BEGIN:VTIMEZONE
TZID:{$timeZone}
TZURL:http://tzurl.org/zoneinfo-outlook/{$timeZone}
X-LIC-LOCATION:{$timeZone}
END:VTIMEZONE
BEGIN:VEVENT
DTSTAMP:$timestamp
DTSTART;TZID={$timeZone}:{$start_date}
DTEND;TZID={$timeZone}:{$end_date}
STATUS:CONFIRMED
SUMMARY:{$title}
DESCRIPTION:{$description}
ORGANIZER;CN=Reminder:MAILTO:support@mysite.com
CLASS:PUBLIC
CREATED:{$start_date}Z
LOCATION:{$location}
URL:http://www.mysite.com
SEQUENCE:1\n";
LAST-MODIFIED:$timestamp
UID:{$title}-support@mysite.com\n";
END:VEVENT\n";
END:VCALENDAR";   
END;

$filename ="event.ics";
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=$filename");
echo $CAL;
