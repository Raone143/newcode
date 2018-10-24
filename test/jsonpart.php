<?php
$row['label'] = "Requisition1";
$row['data'][] = array(1,1);
$row['data'][] = array(2,5);
$row['data'][] = array(3,6);

$rows[] = $row;

$row['label'] = "Requisition2";
$row['data'][] = array(1,1);
$row['data'][] = array(2,5);
$row['data'][] = array(3,6);

$rows[] = $row;

echo json_encode($rows);

echo "<br><br>";


$months['ticks'][] = array(1, '2/11');
$months['ticks'][] = array(2, '2/11');
$months['ticks'][] = array(3, '2/11');
$months['ticks'][] = array(4, '2/11');

echo json_encode($months);
?>