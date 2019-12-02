<?php
include "../data_layer/connection.php";
$db = getConnection();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $delQuery = $db->prepare("DELETE FROM courses WHERE id=?");
    $delQuery->bind_param("s", $id);
    $delQuery->execute();
}
?>