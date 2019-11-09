<?php

include_once(dirname(__FILE__)."/../connection.php");
class School
{
    private $id;
    private $name;

    private function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    // Conversion
    public function toAssoc() {
        return array(
            "id"=>$this->getId(),
            "name"=>$this->getName()
        );
    }

    // SQL queries
    public static function getAllSchools() {

        $cnx = getConnection();
        $sql = "SELECT id, name FROM schools";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();

        $schools = array();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            array_push($schools, new School($row['id'], $row['name']));
        }
        return $schools;
    }

    // Data getters...
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}