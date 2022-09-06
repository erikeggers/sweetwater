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

  // Only run if number of rows is greater than 0.
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row['orderid'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['comment_type'] . "</td><td>" . $row['shipdate_expected'] . "</td></tr>";
    }
  } else {
    echo "No results found";
  }
  
  // Close connection
  $conn->close();
}
