<?php
// determine path, css filename and view mode
$calendarpath="https://www.google.com/calendar/embed?src=[YOUR GOOGLE CALENDAR ID]&ctz=America/New_York";
$newcss="google_calendar.css";
$defaultview=($_GET["v"]) ? $_GET["v"] : "month";
// import the contents of the Google Calendar page into a string
$contents = file_get_contents($calendarpath);
// add secure Google address to root relative links
$contents = str_replace('<link type="text/css" rel="stylesheet" href="', '<link type="text/css" rel="stylesheet" href="https://www.google.com/calendar/', $contents );
$contents = str_replace('<script type="text/javascript" src="', '<script type="text/javascript" src="https://www.google.com/calendar/'  , $contents );
// inject css file reference
$contents = str_replace('<script>function _onload()', '<link rel="stylesheet" type="text/css" href="'.$newcss.'" /><script>function _onload()', $contents );
// update settings found in javascript _onload() function
$contents = str_replace('"view":"month"', '"view":"'.$defaultview.'"', $contents);
$contents = str_replace('"showCalendarMenu":true', '"showCalendarMenu":false', $contents);
if($defaultview == "month") $contents = str_replace('"showDateMarker":true', '"showDateMarker":false', $contents);
if($defaultview != "month") $contents = str_replace('"showTabs":true', '"showTabs":false', $contents);
echo $contents;
?>