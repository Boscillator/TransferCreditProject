<?php

/**
 * Search for similar classes.
 *
 * Request:
 *  GET api/search.php?id=1234
 * Response:
 *   [
 *      {
 *          "id": 2399,
 *          "school": "HVCC",
 *          "code": "HIST 115",
 *          "course_name": "Introduction to African-American History",
 *          "description": "A study of the developments and..."
 *      }, ...
 *  ]
 */

include_once(dirname(__FILE__).'/../data_layer/models/Course.php');

// Tell JQUERY that this response is JSON
header('Content-Type: application/json');

// Load query parameters id and n. Use default of 10 if n is not in the query parameters
$id = intval($_GET['id']);
$n = 10;
if(isset($_GET['n'])) {
    $n = intval($_GET['n']);
}

$c = Course::getById($id);

$matches = array_map(function($course) {
    return $course->toAssoc();
}, $c->getTopMatches($n));

echo json_encode($matches, JSON_PRETTY_PRINT);
