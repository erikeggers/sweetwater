<?php
// Query to get all orders with comments containing Expected Ship Date
$expectedShipDateQuery = "SELECT orderid, comments, shipdate_expected 
                          FROM sweetwater_test
                          WHERE comments like '%Expected Ship Date:%' AND shipdate_expected IS NULL";

$result = $conn->query($expectedShipDateQuery);

// Check if query failed and give error if it did.
if (!$result) {
  die("Query failed: " . $conn->error);
}

// Only run if there are results to be parsed to stop unneccessary updates.
if ($result->num_rows > 0) {
  // Statement to update shipdate_expected field in sweetwater_test table
  $updateDateStatement = $conn->prepare("UPDATE sweetwater_test SET shipdate_expected=? WHERE orderid=?");

  while ($row = $result->fetch_assoc()) {
    // Bind parameters for prepared statement
    $updateDateStatement->bind_param("si", $shipment_date, $orderID);
    
    // Set parameters 
    $orderID = $row['orderid'];
    $userComment = $row['comments'];
    
    // Match string for preg_match
    $matchPattern = '#\d{1,2}/\d{1,2}/\d{2,4}+#';
    
    // Check if comment contains expected ship date
    preg_match($matchPattern, $userComment, $matches);
    $shipment_date_string = $matches[0];
    
    // Convert string to date format
    $shipment_date = new DateTime($shipment_date_string);
    
    // Set date format
    $shipment_date = $shipment_date->format('Y-m-d');
    
    // Update shipdate_expected field in sweetwater_test table
    $updateDateStatement->execute();
  }
}
// Close connection
$conn->close();
