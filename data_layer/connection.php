<?php
include_once './credentials.php';

function getConnection() {
  $connection = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, "TransferCredit");
  if ($connection->connect_errno) {
    echo "Failed to connect " . $connection->connect_error;
  }
  // echo "Connection Successful";
  return $connection;
}