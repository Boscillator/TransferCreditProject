<?php
include_once '../data_layer/models/Course.php';

header('Content-Type: application/json');
$c = Course::getById(1537);
echo json_encode($c->toAssoc());
