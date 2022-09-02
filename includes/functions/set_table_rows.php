<?php

// Get data from database based on query
function setTableRows($query)
{
  include 'includes/dbh.inc.php';

  // Query array
  $queryArray = array(
    "candy" => "SELECT * FROM sweetwater_test WHERE comments like '%candy%' OR comments like '%smarties%' OR comments like '%taffy%'",
    // Noticed some spanish words in the comments, so added Spanish words to the query to catch those as well.
    "calls" => "SELECT * FROM sweetwater_test WHERE (comments like '% call %' OR comments like '% call.%' OR comments like '% calls%' OR comments like '%comunicarse%' OR comments like '%llámame%') AND comments not like '% call your%'",
    "referrals" => "SELECT * FROM sweetwater_test WHERE comments like '%referred%' OR comments like '%referral%'",
    "signatureRequirements" => "SELECT * FROM sweetwater_test WHERE comments like '%signature%' OR comments like '%sign%' OR comments like '%release%'",
    "miscellaneous" => "SELECT * FROM sweetwater_test WHERE comments not in (SELECT comments FROM sweetwater_test WHERE comments like '%candy%' or comments like '%smarties%' or comments like '%taffy%' OR comments like '% call %' OR comments like '% call.%' OR comments like '% calls%' OR comments like '%comunicarse%' OR comments like '%llámame%' OR comments like '%referred%' or comments like '%referral%' OR comments like '%signature%' OR comments like '%sign%' OR comments like '%release%')"
  );

  // Query to get data from database
  $queryToUse = $queryArray[$query];

  // Run query
  $result = $conn->query($queryToUse);

  // Check if query failed and give error if it did.
  if (!$result) {
    die("Query failed: " . $conn->error);
  }

  // Only run if number of rows is greater than 0.
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["orderid"] . "</td><td>" . $row["comments"] . "</td><td>" . $row["shipdate_expected"] . "</td><tr>";
    }
  } else {
    echo "No results found";
  }
  $conn->close();
}