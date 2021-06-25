<html>
<head>
<title>Temperature and Humidity Sensor</title>
</head>
<body style="font-family: Sans-Serif;">
<?php 
$path = "/home/peter/dht/";
$filename = "th_log.csv";
echo "<h2>Temperature and Humidity data</h2>\n";
echo "<h3>from Raspberry Pi u3apeter</h3>\n"; 
echo "<h3>Reading data from file: ".$filename."</h3>\n"; 
$column_colours = ["lightgrey","lightcyan","peachpuff","lightblue"];

echo '<table style="text-align:center; border="0">';
echo "\n";
echo '<tr>';
echo "\n";
echo '<th width="20%" bgcolor= "'.$column_colours[0].'">Date</th>';
echo "\n";
echo '<th width="20%" bgcolor= "'.$column_colours[1].'">Time</th>';
echo "\n";
echo '<th width="30%" bgcolor= "'.$column_colours[2].'">Temperature (C)</th>';
echo "\n";
echo '<th width="30%" bgcolor= "'.$column_colours[3].'">Relative Humidity (%)</th>';
echo "\n";
echo '</tr>';
echo "\n";

$lines = file($path.$filename);
// Output until end-of-file
$reverse_chronological = array_reverse($lines);
foreach ($reverse_chronological as $line) 
{
        $col = 0;
        // Break the line at each comma into its component parts
        $readings = explode(",",$line);
        // Only write output if there's something to write!
        if  ($readings[0] <> "")
        {
                echo "<tr>\n";
                echo '<td bgcolor= "'.$column_colours[0].'">'.$readings[0]."</td>\n";
                echo '<td bgcolor= "'.$column_colours[1].'">'.substr($readings[1],0,2).":00</td>\n";
                echo '<td bgcolor= "'.$column_colours[2].'">'.$readings[2]."</td>\n";
                echo '<td bgcolor= "'.$column_colours[3].'">'.$readings[3]."</td>\n";
                echo " </tr>\n";
        }

}
?>
</table>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<!--- Change reading interval --->
</form> 
</body>
</html>
