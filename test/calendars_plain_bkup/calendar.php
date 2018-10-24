<?php
$year = '2014'; $month = '10'; $firstday = '01';
$d = strtotime(date("$year-$month-$firstday"));
$firstdayname = date('D', $d);

$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$monthdays = array("01"=>"31", "02"=>"28", "03"=>"31", "04"=>"30", "05"=>"31", "06"=>"30", "07"=>"31", "08"=>"31", "09"=>"30", "10"=>"31", "11"=>"30", "12"=>"31");
$days = array("1"=>"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

$calendar = "<table border=\"1\">";

$calendar .= "<tr><td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td></tr>";

$d = 1;
$dii = 1;
$di = 1;
$firstdayindex = false;
for($r = 0; $r < 6; $r++) {
	$calendar .= "<tr>";
		
		if($di <= 7) {
			for($di = 1; $di <= 7; $di++) {
				if($days[$di] == $firstdayname && $firstdayindex == false) {
					$firstdayindex = true;
				}
				if($firstdayindex == true) {
					$calendar .= "<td>$dii</td>";
					$dii++;
				}
				else {
					$calendar .= "<td>&nbsp;</td>";
				}
			}	
		}
		else 
		{
			for($di = $d; $di < ($d + 7); $di++) {
				$calendar .= "<td>$dii</td>";
				if($monthdays[$month] == $dii) {
					$r = 6;
					$di = 41;
				}
				$dii++;
			}	
		}		
		
		$d = $di - 1;
	
	$calendar .= "</tr>";
	
	
}

$calendar .= "</table>";

echo $calendar;