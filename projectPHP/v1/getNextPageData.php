<?php

require_once('../include/conn.php');

// require_once '../include/DbOperation.php';
//$result = $conn->query("select * from studentProfile;");
$result = $conn->query("
SELECT
    studentProfile.student_name,
    department.department_name,
    grade.grade_level,
    class.class_name,
    studentStatus.status_ing,
    qrcode.qrcode_ing,
    transportation.transportation_name
FROM
    studentProfile AS studentProfile,
    department AS department,
    grade AS grade,
    class AS class,
    studentStatus AS studentStatus,
    qrcode AS qrcode,
    transportation AS transportation
WHERE
    studentProfile.student_ID = department.department_ID AND 
    studentProfile.student_ID = grade.grade_ID AND 
    studentProfile.student_ID = class.class_ID AND 
    studentProfile.student_ID = studentStatus.status_ID AND
    studentProfile.student_ID = qrcode.qrcode_ID AND 
    studentProfile.student_ID = transportation.transportation_ID;
");
if(!$result){
    die($conn->error);
}

while ($row = $result->fetch_assoc()){

    echo "學生姓名:" . $row['student_name'] . '<br>';
    echo "科系:" . $row['department_name'] . '<br>';
    echo "年級:" . $row['grade_level'] . '<br>';
    echo "班級:" . $row['class_name'] . '<br>';
    echo "學籍狀態:" . $row['status_ing'] . '<br>';
    echo "QRcode狀態:" . $row['qrcode_ing'] . '<br>';
    echo "交通工具:" . $row['transportation_name'] . '<br>';
    echo '<br>';

}

?>
