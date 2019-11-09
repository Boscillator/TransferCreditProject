<?php

include_once(dirname(__FILE__)."/../connection.php");

class Course
{

    private $id;
    private $school;
    private $code;
    private $course_name;
    private $description;

    private function __construct($id, $school, $code, $course_name, $description)
    {
        $this->id = $id;
        $this->school = $school;
        $this->code = $code;
        $this->course_name = $course_name;
        $this->description = $description;
    }


    // Data convection
    public function toAssoc() {
        return array(
            "id"=>$this->id,
            "school"=>$this->school,
            "code"=>$this->code,
            "course_name"=>$this->course_name,
            "description"=>$this->description
        );
    }


    // Database queries

    /**
     * @param $id
     * @return Course the course with the id
     */
    public static function getById($id) {
        $cnx = getConnection();
        $sql = "SELECT id, school, code, course_name, description FROM courses WHERE id = ? LIMIT 1";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();
        return new Course(
            $row['id'],
            $row['school'],
            $row['code'],
            $row['course_name'],
            $row['description']
        );
    }


    // Property Getters
    public function getDescription()
    {
        return $this->description;
    }

    public function getCourseName()
    {
        return $this->course_name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function getId()
    {
        return $this->id;
    }
}

