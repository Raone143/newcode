<?php
// Request Values
$SYear = '2014';
$SMonth = '09';
$SDay = '01';

function calendarListView($SYear, $SMonth, $SDay) {
	$time = strtotime ( date ( "$SYear-$SMonth-$SDay" ) );
	$MonthName = date ( 'F', $time );
	$daysInMonth = cal_days_in_month ( 0, $SMonth, $SYear );
	$c = "";
	$c .= "<table width=\"100%\" border=\"1\">";
	$c .= "<tr><th colspan=\"7\" align=\"left\">" . $MonthName . " " . $SYear . "</th></tr>";
	for($i = 1; $i <= $daysInMonth; $i++) {
		// print days
		$c .= "<tr>";
		$c .= "<td width='15%' valign='top'>" . date ( 'l', strtotime ( date ( "$SYear-$SMonth-$i" ) ) ) . "</td>";
		$c .= "<td valign='top'>" . $i . "</td>";
		$c .= "<td>Have to display<br><br><br><br></td>";
		$c .= "</tr>";
	}
	$c .= "</table>";
	// Print the entire calendar
	return $c;
}
echo calendarListView($SYear, $SMonth, $SDay);