<?php
require("phpsqlajax_dbinfo.php");
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

//Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

//Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
 die ('Can\'t use db : ' . mysql_error());
}

//Select all the rows in the markers table

$query = "SELECT * FROM vehicle WHERE 1";
$result = mysql_query($query);
if (!$result) {
	die('Invalid query: ' . mysql_error());
}

//$result = DB::select('select * from geolocation', array(1));

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

//foreach ($results as $row){
while ($row = @mysql_fetch_assoc($result)) {
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", $row['id']);
  $newnode->setAttribute("driverid", $row['driverId']);
  
  //fetch drivername matching to driver id assigned for each vehicle
  $query2 = mysql_query("SELECT * FROM driver WHERE id = " . $row['driverId']);
  $row2 = mysql_fetch_array($query2);
  //$drivername = $data[0];

  $newnode->setAttribute("realName", $row2['realName']);
  $newnode->setAttribute("vehicleType", $row['vehicleType']);
  $newnode->setAttribute("plateNumber", $row['plateNumber']);
  // $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("status", $row['status']);
}

echo $dom->saveXML();

?>