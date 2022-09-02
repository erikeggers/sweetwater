<?php
  include 'includes/functions/set_table_rows.php';
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