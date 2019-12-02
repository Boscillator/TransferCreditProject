<?php
include '../data_layer/connection.php';
$conn = getConnection();

if(isset($_POST['id'])){
    $val = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];

    $sql = "UPDATE courses SET $column = ? WHERE id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("ss", $val, $id);
    $query->execute();
}
?>