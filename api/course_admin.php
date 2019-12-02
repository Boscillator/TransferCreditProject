<?php
    include "../data_layer/connection.php";
    include_once(dirname(__FILE__) . '/../data_layer/models/Course.php');

    $cnx = getConnection();
    $id = intval($_POST['school_id']);
    $sql = "
            SELECT courses.id, sc.name, code, course_name
            FROM courses
            JOIN schools sc ON courses.school = sc.id
            WHERE sc.id = $id";
    $result = mysqli_query($cnx, $sql);  
    $output = '<table>
                    <tr>
                        <th>Course Code</th>
                        <th>Name</th>
                        <th>School</th>
                    </tr>';
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $code = $row['code'];
        $name = $row['course_name'];
        $school = $row['name'];
        $output .= '<tr>
                        <td><div contenteditable="true" onBlur="updateValue(this, "code")">'.$code.'</div></td>
                        <td><div contenteditable="true" onBlur="updateValue()">'.$name.'</div></td>
                        <td>'.$school.'</td>
                    </tr>';
    }
    $output .= '</table>';
    echo $output;
?>

