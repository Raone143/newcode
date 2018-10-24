<?php
// echo 10 + "15%" + "$20";
$con = mysql_connect ( 'localhost', 'root', '' );
$db = mysql_select_db ( 'srimangalyabhagya', $con );

$nakshtra = array (
		'17' => 'Anuradha / Anusham / Anizham',
		'6' => 'Ardra / Thiruvathira',
		'9' => 'Ashlesha / Ayilyam',
		'1' => 'Ashwini / Ashwathi',
		'2' => 'Bharani',
		'14' => 'Chitra / Chitha',
		'23' => 'Dhanista / Avittam',
		'13' => 'Hastha / Atham',
		'18' => 'Jyesta / Kettai',
		'3' => 'Krithika / Karthika',
		'10' => 'Makha / Magam',
		'19' => 'Moolam / Moola',
		'5' => 'Mrigasira / Makayiram',
		'25' => 'Poorvabadrapada / Puratathi',
		'11' => 'Poorvapalguni / Puram / Pubbhe',
		'20' => 'Poorvashada / Pooradam',
		'7' => 'Punarvasu / Punarpusam',
		'8' => 'Pushya / Poosam / Pooyam',
		'27' => 'Revathi',
		'4' => 'Rohini',
		'24' => 'Shatataraka / Sadayam / Satabishek',
		'22' => 'Shravan / Thiruvonam',
		'15' => 'Swati / Chothi',
		'26' => 'Uttarabadrapada / Uthratadhi',
		'12' => 'Uttarapalguni / Uthram',
		'21' => 'Uttarashada / Uthradam',
		'16' => 'Vishaka / Vishakam' 
);

ksort ( $nakshtra );

foreach ( $nakshtra as $lkey => $lval ) {
	$ins = "INSERT INTO nakshtra(nakshtra_id, nakshtra_name) VALUES('" . $lkey . "', '" . $lval . "')";
	$res = mysql_query ( $ins );
}
?>