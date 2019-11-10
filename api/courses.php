<?php
include_once(dirname(__FILE__).'/../data_layer/models/Course.php');

header('Content-Type: application/json');

$id = intval($_GET['school_id']);
$courses = array_map(function($course) {
    return $course->toAssoc();
}, Course::getCoursesForSchool($id));

echo json_encode($courses, JSON_PRETTY_PRINT);
