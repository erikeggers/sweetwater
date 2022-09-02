<?php
// Get data from database based on query
function setTableRows($type)
{
  include 'includes/dbh.inc.php';
  
  // Query array
  $types = array(
    "candy" => "SELECT * FROM sweetwater_test WHERE comments like '%candy%' OR comments like '%smarties%' OR comments like '%taffy%'",
  );

  $queryToUse = $types[$type];

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
</body>
</html>