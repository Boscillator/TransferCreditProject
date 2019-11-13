<?php

include_once(dirname(__FILE__)."/../connection.php");

/**
 * Represents a collage or university.
 */
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

    /**
     * Converts the school into an associative array so it can be serialized to JSON.
     * @return array
     */
    public function toAssoc() {
        return array(
            "id"=>$this->getId(),
            "name"=>$this->getName()
        );
    }

    // SQL queries

    /**
     * Get a list of all schools known to the system.
     * @return array
     */
    public static function getAllSchools() {

        // Run the query
        $cnx = getConnection();
        $sql = "SELECT id, name FROM schools";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();

        // Copy results into an array of `School` objects
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