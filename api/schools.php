<?php

/*
 * Get a list of all schools
 *
 * Request:
 *  GET api/schools
 * Response:
 *  [
 *  {
 *      "id": 1,
 *      "name": "UMD"
 *  },
 *  {
 *      "id": 2,
 *      "name": "HVCC"
 *  }
 * ]
 */

include_once(dirname(__FILE__).'/../data_layer/models/School.php');

// Tell JQUERY that this response is JSON
header('Content-Type: application/json');

// Get list of all schools
$schools = School::getAllSchools();

// Convert it to something `json_encode` can handle
$array_map = [];
foreach ($schools as $key => $school) {
    $array_map[$key] = $school->toAssoc();
}
$schools = $array_map;
echo json_encode($schools, JSON_PRETTY_PRINT);
