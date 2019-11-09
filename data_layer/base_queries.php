<?php

Include_once 'connection.php';

// return an array contains correct results from sql table
function get_properties_from_table($table, $properties, $specific = NULL, $specific_value = NULL) {
  $propSubstring = "";
  foreach ($properties as $key => $value) {
    $propSubstring = $propSubstring .  $value . ', ';
  }
  $propSubstring = rtrim($propSubstring, ", ");
  $connect = getConnection();
  $query = "SELECT $propSubstring FROM $table";
  if (!is_null($specific)) {
    $query .= " WHERE " . $specific . " = " . $specific_value;
  }
  $result = $connect->query($query);
  $resultArray = $result->fetch_all(MYSQLI_ASSOC);
  return $resultArray;
}
?>