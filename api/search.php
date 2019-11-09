<?php
include_once(dirname(__FILE__).'/../data_layer/models/Course.php');

header('Content-Type: application/json');

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
