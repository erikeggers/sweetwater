<?php

// Server credentials. This would normally be stored in a separate file and use environment variables.
$server = "localhost";
$username = "root";
$password = "";
$db = "sweetwater";

// Create connection to local server.
$conn = mysqli_connect($server, $username, $password, $db);

// Check server connection 
// Give error if connection fails.
if (!$conn) {
  die("Connection to server failed: " . mysqli_connect_error());
}
