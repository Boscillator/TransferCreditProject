<?php
include 'data_layer/connection.php';
$conn = getConnection();

if(isset($_POST['id'])){
    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];

    $sql = "UPDATE courses SET $column = :value WHERE id = :id LIMIT 1";
    $query = $conn->prepare($sql);
    $query -> bindParam('column', $value);
    $query -> bindParam('id', $id);

    if($sql->execute()) {
        echo "Update Successfull";
    } else {
        echo "Failure";
    }
}
?>