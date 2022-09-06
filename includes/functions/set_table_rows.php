<?php

// Get data from database based on query
function setTableRows()
{
  // Include database connection
  include 'includes/dbh.inc.php';

  // Set query to use
  $queryToUse = "SELECT orderid, comments, shipdate_expected,
                IF((comments LIKE '%candy%' OR comments LIKE '%smarties%' OR comments LIKE '%taffy%'), 'Candy', 
                IF((comments LIKE '%call%' OR comments LIKE '%contact%' OR comments LIKE '%comunicarse%' OR comments LIKE '%llámame%'), 'Call Related', 
                IF((comments LIKE '%signature%' OR comments LIKE '%sign%' OR comments LIKE '%release%'), 'Signature Requirements', 
                IF(comments LIKE '%referred%' OR comments LIKE '%referral%', 'Referrals', 'Miscellaneous')))) AS comment_type 
                FROM sweetwater_test ORDER BY comment_type";

  // Run query
  $result = $conn->query($queryToUse);

  // Check if query failed and give error if it did.
  if (!$result) {
    die("Query failed: " . $conn->error);
  }

  // Arrays to hold each comment type
  $candy = array();
  $call = array();
  $signature = array();
  $referral = array();
  $misc = array();

  // For each comment in the candy array, create a table row
  while ($row = $result->fetch_assoc()) {
    if ($row['comment_type'] == 'Candy') {
      array_push($candy, $row);
    } elseif ($row['comment_type'] == 'Call Related') {
      array_push($call, $row);
    } elseif ($row['comment_type'] == 'Signature Requirements') {
      array_push($signature, $row);
    } elseif ($row['comment_type'] == 'Referrals') {
      array_push($referral, $row);
    } elseif ($row['comment_type'] == 'Miscellaneous') {
      array_push($misc, $row);
    }
  }

  // Candy Related
  echo "<h2>Candy</h2><table border='1'><tr><th>Order ID</th><th>Comments</th><th>Type</th><th>Expected Ship Date</th></tr>";
  foreach ($candy as $row) {
    echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
  }
  echo "</table>";

  // Call Related
  echo "<h2>Call Related</h2><table border='1'><tr><th>Order ID</th><th>Comments</th><th>Type</th><th>Expected Ship Date</th></tr>";
  foreach ($call as $row) {
    echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
  }
  echo "</table>";

  // Signature Requirements
  echo "<h2>Signature Requirements</h2><table border='1'><tr><th>Order ID</th><th>Comments</th><th>Type</th><th>Expected Ship Date</th></tr>";
  foreach ($signature as $row) {
    echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
  }
  echo "</table>";

  // Referrals
  echo "<h2>Referrals</h2><table border='1'><tr><th>Order ID</th><th>Comments</th><th>Type</th><th>Expected Ship Date</th></tr>";
  foreach ($referral as $row) {
    echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
  }
  echo "</table>";

  // Miscellaneous
  echo "<h2>Miscellaneous</h2><table border='1'><tr><th>Order ID</th><th>Comments</th><th>Type</th><th>Expected Ship Date</th></tr>";
  foreach ($misc as $row) {
    echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
  }
  echo "</table>";

  // Close connection
  $conn->close();
}
