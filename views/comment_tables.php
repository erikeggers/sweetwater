<?php
  include 'includes/functions/set_table_rows.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sweetwater Comments</title>
  <link rel="stylesheet" href="styles/main.css">
</head>

<body>
  <img src="https://media.sweetwater.com/m/header/logo/sweetwater-logo.png?width=190&quality=90&ha=9fec6b575dbcf9ae" alt="sweetwater logo">
  <h1>Customer Comments</h1>
  <!-- Candy Comments Table -->
  <table border='1'>
    <tr>
      <th>Order ID</th>
      <th>Comments</th>
      <th>Type</th>
      <th>Expected Ship Date</th>
    </tr>
    <!-- Get data from table related to candy-->
    <?php
    echo setTableRows("candy");
    ?>
  </table>
  <!-- Call Comments Table -->
 </body>

</html>