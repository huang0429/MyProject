<?php

require_once('../include/conn.php');

//$result = $conn->query("select * from news;");
$result = $conn->query("
SELECT
    news.news_ID,
    news.news_title,
    news.news_date,
    news.news_content,
    unit.unit_name,
    personnel.personnel_name
FROM
    news AS news,
    unit AS unit,
    personnel AS personnel
WHERE
    news.news_ID = unit.unit_ID AND news.news_ID = personnel.personnel_ID;
");
if(!$result){
    die($conn->error);
}

while ($row = $result->fetch_assoc()){

    echo "News ID:" . $row['news_ID'] . '<br>';
    echo "主文:" . $row['news_title'] . '<br>';
    echo "發佈時間:" . $row['news_date'] . '<br>';
    echo "內文:" . $row['news_content'] . '<br>';
    echo "發文單位:" . $row['unit_name'] . '<br>';
    echo "發文人:" . $row['personnel_name'] . '<br>';
    echo '<br>';
}
?>