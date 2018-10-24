<script src="fusioncharts-jquery-plugin.js"></script>
<?php
include 'fusioncharts.php';

// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.

 // Create the chart - Column 2D Chart with data given in constructor parameter
 // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
 $columnChart = new FusionCharts("Column2D", "myFirstChart" , 600, 300, "chart-1", "json", '{"chart":{"caption":"Monthly revenue for last year","subCaption":"Harry\'s SuperMart","xAxisName":"Month","yAxisName":"Revenues (In USD)","numberPrefix":"$","paletteColors":"#0075c2","bgColor":"#ffffff", "borderAlpha": "20", "canvasBorderAlpha": "0", "usePlotGradientColor":"0", "plotBorderAlpha":"10", "placeValuesInside": "1", "rotatevalues": "1", "valueFontColor": "#ffffff", "showXAxisLine": "1", "xAxisLineColor": "#999999", "divlineColor": "#999999", "divLineIsDashed": "1", "showAlternateHGridColor":"0", "subcaptionFontSize":"14", "subcaptionFontBold":"0" },"data":[{"label":"Jan","value":"420000"},{"label":"Feb","value":"810000"},{"label":"Mar","value":"720000"},{"label":"Apr","value":"550000"},{"label":"May","value":"910000"},{"label":"Jun","value":"510000"},{"label":"Jul","value":"680000"}, {"label":"Aug","value":"620000"}, {"label":"Sep","value":"610000"}, {"label":"Oct","value":"490000"}, {"label":"Nov","value":"900000"}, {"label":"Dec","value":"730000"}]}');
 // Render the chart
 $columnChart->render();
?>
<div id="chart-1"><!-- Fusion Charts will render here--></div>