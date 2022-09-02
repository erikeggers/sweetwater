<?php
include 'includes/dbh.inc.php';
$testQuery = "SELECT * FROM sweetwater_test";

$result = $conn->query($testQuery);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "orderID: " . $row["orderid"]. " - comments: " . $row["comments"]. " " . $row["shipdate_expected"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>