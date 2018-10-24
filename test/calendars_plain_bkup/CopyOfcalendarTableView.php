<?php
$days = array (
		"1" => "Su",
		"Mo",
		"Tu",
		"We",
		"Th",
		"Fr",
		"Sa" 
);

$SYear = '2014';
$SMonth = '09';
$SDay = '01';

$time = strtotime ( date ( "$SYear-$SMonth-$SDay" ) );

$numDay = date ( 'd', $time );
$numMonth = date ( 'm', $time );
$strMonth = date ( 'F', $time );
$numYear = date ( 'Y', $time );
$firstDay = mktime ( 0, 0, 0, $numMonth, 1, $numYear );
$daysInMonth = cal_days_in_month ( 0, $numMonth, $numYear );
$dayOfWeek = date ( 'w', $firstDay );

$c = '<table width="20%">';
$c .= '<tr><td colspan="7" align="center">' . $strMonth . ' ' . $numYear . '</td></tr>';

$c .= "<tr>";
for($d = 1; $d <= 7; $d ++) {
	$c .= "<th align='left'>" . $days [$d] . "</th>";
}
$c .= "</tr>";
$c .= "<tr>";
$trclosed = false;

// Create empty cells until before first day starts
for($k = 1; $k <= $dayOfWeek; $k ++) {
	$c .= "<td>&nbsp;</td>";
}

for($i = 1; $i <= $daysInMonth; $i ++) {
	// Flag for tr opened or closed
	$trclosed = false;
	
	// print days
	$c .= "<td>" . $i . "</td>";
	
	// Open and close tr properly
	if (date ( 'w', mktime ( 0, 0, 0, $numMonth, $i, $numYear ) ) == 6) {
		$trclosed = true;
		$c .= "</tr>";
	}
	if ((date ( 'w', mktime ( 0, 0, 0, $numMonth, $i, $numYear ) ) == 6) && $daysInMonth != $i) {
		$c .= "<tr>";
	}
}

if ($trclosed == false)
	$c .= "</tr>";

$c .= "</table>";

// Print the entire calendar
echo $c;