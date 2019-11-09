<?php
include_once(dirname(__FILE__).'/../data_layer/models/School.php');

$schools = School::getAllSchools();
$schools = array_map(function($school){
    return $school->toAssoc();
}, $schools);
echo json_encode($schools, JSON_PRETTY_PRINT);
