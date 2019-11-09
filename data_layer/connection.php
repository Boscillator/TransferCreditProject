<?php
function getConnection() {
  $connection = new mysqli("localhost", "username", "password", "TransferCredit");
  if ($connection->connect_errno) {
    echo "Failed to connect " . $connection->connect_error;
  }
  // echo "Connection Successful";
  return $connection;
}
?>