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
            <li><a href="#">Search</a></li>
            <li class="active"><a href="#">Admin</a></li>
        </ul>
    </div>
</div>
<div id="container">
    <form id="search_body">
        <p>School</p>
        <select disabled id="school_select">
            <option value="">SELECT A SCHOOL</option>
        </select>
    </form>
    <section id="results_body">
        <table>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Name</th>
                    <th>School</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
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