<?php
include('connect.php');
    $cat_id = $_POST['cat_id']; // передаем переменной email значение глобального массива POST
    $man_id = $_POST['man_id'];
    $cert_name = $_POST['cert_name'];
    $cert_number = $_POST['cert_number'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $cert_center = $_POST['cert_center'];
    $photo_url = $_POST['photo_url'];

    $sql = mysql_query('INSERT INTO certificate(cat_id, man_id, name, number, date_start, date_end, cert_center, photo_url)
    VALUES("'.$cat_id.'", "'.$man_id.'", "'.$cert_name.'", "'.$cert_number.'", "'.$date_start.'", "'.$date_end.'", "'.$cert_center.'", "'.$photo_url.'")');
    // проверка
    if($sql=='false')
    {echo '<p><b>Failed!</b></p>';}
    else
    {echo '<p><b>Added!</b></p>';}
?>