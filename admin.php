<?php
    include 'data_layer/connection.php';
    $db = getconnection();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Admin Page</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<div class="header clearfix">
    <div class="left">
        <div class="logo">CourseLead</div>
    </div>
    <div class="right menubox">
        <ul class="menu">
            <li><a href="main_page.html">Search</a></li>
            <li class="active"><a href="#">Admin</a></li>
        </ul>
    </div>
</div>
<div id="container">
    <div id="search_body">
    <?php
    if (isset($_POST['add'])) {
        $codeForDb = trim($_POST["code"]);  
        $courseForDb = trim($_POST["name"]);
        $schoolForDb = $_POST['school'];
        
        $insQuery = "insert into courses (`school`,`code`,`course_name`) values(?,?,?)";
        $statement = $db->prepare($insQuery);

        $statement->bind_param("sss",$schoolForDb,$codeForDb,$courseForDb);

        $statement->execute();
    }
    ?>
    <form method='post' action='admin.php'>
        <h2>Select School</h2>
        <select name="school" disabled id="school_select">
            <option value="">SELECT A SCHOOL</option>
        </select>
        <h2>Add Course</h2>
        <p>Code: <br><input type="text" name="code" /></p>
        <p>Course Name: <br><input type="text" name="name" /></p>
        <button type='submit' name='add'>Submit</button>
    </form>
    </div>
    <section id="results_body">
        <table>
            <tr>
                <th>Course Code</th>
                <th>Name</th>
                <th>School</th>
            </tr>
        </table>
    </section>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="js/admin.js"></script>
</body>
</html>