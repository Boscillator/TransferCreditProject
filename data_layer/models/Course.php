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
        $this->school = utf8_encode($school);
        $this->code = utf8_encode($code);
        $this->course_name = trim(utf8_encode($course_name));
        $this->description = trim(utf8_encode($description));
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
        $sql = "SELECT courses.id, sc.name, code, course_name, description FROM courses
                JOIN schools sc ON courses.school = sc.id
                WHERE courses.id = ? LIMIT 1";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();
        return new Course(
            $row['id'],
            $row['name'],
            $row['code'],
            $row['course_name'],
            $row['description']
        );
    }

    /**
     * Gets a list of courses that are likely to be similar to this course.
     * @param $n int number of matches to return
     * @return array
     */
    public function getTopMatches($n) {
        $cnx = getConnection();
        $sql = "
            SELECT matches.id, sc.name, code, course_name, description
            FROM courses AS matches
            JOIN course_index ci ON matches.id = ci.course_b
            JOIN schools sc ON matches.school = sc.id
            WHERE ci.course_a = ?
            ORDER BY ci.score DESC
            LIMIT ?";
        $stmt = $cnx->prepare($sql);
        $myId = $this->getId();
        $stmt->bind_param("ii",$myId, $n);
        $stmt->execute();

        $result = $stmt->get_result();
        $matches = array();
        while($row = $result->fetch_assoc()) {
            array_push($matches, new Course(
                $row['id'],
                $row['name'],
                $row['code'],
                $row['course_name'],
                $row['description']
            ));
        }

        return $matches;
    }

    public static function getCoursesForSchool($school_id) {
        $cnx = getConnection();
        $sql = "
            SELECT courses.id, sc.name, code, course_name, description
            FROM courses
            JOIN schools sc ON courses.school = sc.id
            WHERE sc.id = ?";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("i",$school_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $matches = array();
        while($row = $result->fetch_assoc()) {
            array_push($matches, new Course(
                $row['id'],
                $row['name'],
                $row['code'],
                $row['course_name'],
                $row['description']
            ));
        }

        return $matches;
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

