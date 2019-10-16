<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
    <form action="index.php" method="post">
        <fieldset>
            <input type="text" size="70" value="" name="school" id="school" placeholder="School Name"/>
            <input type="text" size="70" value="" name="course" id="course" placeholder="Course Title"/>
            <input type="submit" value="SEARCH" id="search" name="search"/>
        </fieldset>
    </form>

    <?php
    if(isset($_POST["search"])) {
    include "server/connection.php";
    $school = htmlspecialchars(trim($_POST["school"]));
    $course = htmlspecialchars(trim($_POST["course"]));
    $conn = getConnection();
    $query = "SELECT description FROM courses WHERE course_name = '$course' and school = '$school'";
    $response = mysqli_query($conn,$query);
    // run similarity algorithm here, then echo out all the result
    //

    if($response) {
        echo $query;
    }
    mysql_close($conn);
    }
    ?>
</body>
</html>
