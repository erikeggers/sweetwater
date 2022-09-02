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


  $queryToUse = $queryArray[$query];

  $result = $conn->query($queryToUse);

  // Check if query was successful
  if (!$result) {
    die("Query failed: " . $conn->error);
  }

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sweetwater Comments</title>
</head>

<body>
  <h1>Customer Comments</h1>
  <!-- Candy Comments Table -->
  <h2>Candy</h2>
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Expected Delivery</th>
    </tr>
    <!-- Get data from table related to candy-->
    <?php
    echo setTableRows("candy");
    ?>
  </table>
  <!-- Call Comments Table -->
  <h2>Call Related</h2>
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Expected Delivery</th>
    </tr>
    <!-- Get data related to calls -->
    <?php
    echo setTableRows("calls");
    ?>
  </table>
  <!-- Referral Comments Table -->
  <h2>Referrals</h2>
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Expected Delivery</th>
    </tr>
    <!-- Get data related to referrals -->
    <?php
    echo setTableRows("referrals");
    ?>
  </table>
  <!-- Signature Requirements Comments Table -->
  <h2>Signature Requirements</h2>
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Expected Delivery</th>
    </tr>
    <!-- Get data related to signatures -->
    <?php
    echo setTableRows("signatureRequirements");
    ?>
  </table>
  <!-- Miscellaneous Comments Table -->
  <h2>Miscellaneous</h2>
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Expected Delivery</th>
    </tr>
    <!-- Get data related to Miscellaneous -->
    <?php
    echo setTableRows("miscellaneous");
    ?>
  </table </body>

</html>