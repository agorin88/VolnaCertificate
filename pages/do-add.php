<?php
include ('../core.php');
    $db = new SafeMySQL();
    $table = "certificate";

    $cat_id = mysql_real_escape_string($_POST['cat_id']); // передаем переменной значение глобального массива POST
    $man_id = mysql_real_escape_string($_POST['man_id']);
    $cert_name = mysql_real_escape_string($_POST['cert_name']);
    $cert_number = mysql_real_escape_string($_POST['cert_number']);
    $date_start = mysql_real_escape_string($_POST['date_start']);
    $date_end = mysql_real_escape_string($_POST['date_end']);
    $cert_center = mysql_real_escape_string($_POST['cert_center']);
    $photo_url = mysql_real_escape_string($_POST['photo_url']);
    $added = date('Y\-m\-d');

    $data = array('cat_id'=>$cat_id, 'man_id'=>$man_id, 'cert_name'=>$cert_name, 'cert_number'=>$cert_number, 'date_start'=>$date_start, 'date_end'=>$date_end, 'cert_center'=>$cert_center, 'photo_url'=>$photo_url);
    $sql = "INSERT INTO ?n SET cat_id = ?s, man_id = ?s, name = ?s, number = ?s, date_start = ?s, date_end = ?s, cert_center = ?s, photo_url = ?s, added = ?s";
    if (!$db->query($sql, $table, $cat_id, $man_id, $cert_name, $cert_number, $date_start, $date_end, $cert_center, $photo_url, $added))
        print_r("<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>");
    else {
        print_r("<div class=\"alert alert-add alert-success\">
<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
<strong>Добавлено!</strong> Ваша запись успешно добавлена.
</div>");
    }


/*if (!mysql_query('INSERT INTO certificate(cat_id, man_id, name, number, date_start, date_end, cert_center, photo_url) VALUES("' . $cat_id . '", "' . $man_id . '", "' . $cert_name . '", "' . $cert_number . '", "' . $date_start . '", "' . $date_end . '", "' . $cert_center . '", "' . $photo_url . '")'))
        print_r("<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>");
    else {
        print_r("<div class=\"alert alert-add alert-success\">
<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
<strong>Добавлено!</strong> Ваша запись успешно добавлена.
</div>");
    }*/

?>