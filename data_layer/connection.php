<?php
include_once(dirname(__FILE__).'/credentials.php');
$_connection_cnx = null;
function getConnection() {
    global $_connection_cnx;

    if(!is_null($_connection_cnx)) {
        return $_connection_cnx;
    }

    $connection = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, "TransferCredit");
    if ($connection->connect_errno) {
        echo "Failed to connect " . $connection->connect_error;
    }

    $_connection_cnx = $connection;

    return $connection;
}