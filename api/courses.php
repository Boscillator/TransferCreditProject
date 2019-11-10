<?php

/*
 * Get a list of all courses offered at a school.
 *
 * Request:
 *  GET api/courses.php?school_id=1
 * Response:
 *  [
 *      {'id':2456, 'course_name': 'Web Art and Design', 'code':'DART 120'... }
 *      ...
 *  ]
 */

include_once(dirname(__FILE__) . '/../data_layer/models/Course.php');

// Tell JQUERY that this response is JSON
header('Content-Type: application/json');

// Get the school we care about from the URL query parameters.
$id = intval($_GET['school_id']);
$courses = Course::getCoursesForSchool($id);    // Courses contains a list of Course objects

// Convert the courses into something `json_encode` can handle
$json_list = [];
foreach ($courses as $key => $course) {
    $json_list[$key] = $course->toAssoc();
}

echo json_encode($json_list, JSON_PRETTY_PRINT);
