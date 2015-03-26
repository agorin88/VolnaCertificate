<?php
//Get page number from Ajax
if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
    $page_number = 1; //if there's no page number, set it to 1
}

//get total number of records from database
$results = mysql_query("SELECT COUNT(*) FROM cert.certificate");
$get_total_rows = mysql_fetch_row($results); //hold total records in variable
//break records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

//fetch position of record
$page_position = (($page_number-1) * $item_per_page);

//Запрос к БД для основной таблицы сертификатов.
$query ="SELECT
`certificate`.`id` ,
`certificate`.`name` ,
`certificate`.`date_start` ,
`certificate`.`date_end` ,
`certificate`.`number` ,
`certificate`.`cert_center` ,
`certificate`.`photo_url` AS 'link' ,
`man`.`name` AS  'manname',
`cat`.`name` AS  'catname'
FROM certificate
LEFT JOIN cat ON cat.id = certificate.cat_id
LEFT JOIN man ON man.id = certificate.man_id
WHERE cat.id =  '".$_GET['catid']."'
ORDER BY  `certificate`.`id` ASC
LIMIT $page_position, $item_per_page";

$result = mysql_query("$query");
$count = mysql_num_rows($result);

//Запрос просроченных сертификатов
$o_date = date('Y\-m\-d');
$out_query = "SELECT
`certificate`.`id` ,
`certificate`.`name` ,
`certificate`.`date_start` ,
`certificate`.`date_end` ,
`certificate`.`number` ,
`certificate`.`cert_center` ,
`certificate`.`photo_url` AS 'link' ,
`man`.`name` AS  'manname'
FROM certificate
LEFT JOIN man ON man.id = certificate.man_id
WHERE date_end < '$o_date' && date_end != '0000-00-00'
ORDER BY  `certificate`.`id` ASC
LIMIT $page_position, $item_per_page";
$outdate = mysql_query("$out_query");

//Запрос к таблице категорий.
$catquery = "SELECT * FROM cat";
$result_cat = mysql_query("$catquery");
$result_cat2 = mysql_query("$catquery");

//Запрос к таблице производителей
$manquery = "SELECT * FROM man";
$result_man = mysql_query("$manquery");


//Добавление сертификата
/*
function add_cert()
{
    if (isset($_POST['submit'])) {
        $cat_id = mysql_real_escape_string($_POST['cat_id']); // передаем переменной значение глобального массива POST
        $man_id = mysql_real_escape_string($_POST['man_id']);
        $cert_name = mysql_real_escape_string($_POST['cert_name']);
        $cert_number = mysql_real_escape_string($_POST['cert_number']);
        $date_start = mysql_real_escape_string($_POST['date_start']);
        $date_end = mysql_real_escape_string($_POST['date_end']);
        $cert_center = mysql_real_escape_string($_POST['cert_center']);
        $photo_url = mysql_real_escape_string($_POST['photo_url']);
        if (!mysql_query('INSERT INTO certificate(cat_id, man_id, name, number, date_start, date_end, cert_center, photo_url) VALUES("' . $cat_id . '", "' . $man_id . '", "' . $cert_name . '", "' . $cert_number . '", "' . $date_start . '", "' . $date_end . '", "' . $cert_center . '", "' . $photo_url . '")'))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Добавлено!</strong> Ваша запись успешно добавлена.
                </div>";
        }
    }
}
*/

//Добавление категории
function add_cat()
{
    if (isset($_POST['submit'])) {
        $catname = addslashes($_POST['cat_name']);

        if (!mysql_query('INSERT INTO cat(name) VALUES ("' . $catname . '")'))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Добавлено!</strong> Ваша запись успешно добавлена.
                    </div>";
        }
    }
}

function del_cat() {
    if (isset($_POST['delete'])) {
        $del_cat = $_POST['del_cat_id'];
        if (!mysql_query("DELETE FROM cat WHERE id = $del_cat"))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Удалено!</strong> Ваша запись успешно удалена.
                    </div>";
        }
    }
}

//Добавление производителя
function add_man()
{
    if (isset($_POST['subman'])) {
        $manname = addslashes($_POST['man_name']);
        $maninfo = addslashes($_POST['man_info']);

        if (!mysql_query("INSERT INTO man(name, info) VALUES ('".$manname."', '".$maninfo."' )"))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Добавлено!</strong> Ваша запись успешно добавлена.
                    </div>";
        }
    }
}

function del_man() {
    if (isset($_POST['delman'])) {
        $del_man = $_POST['del_man_id'];
        if (!mysql_query("DELETE FROM man WHERE id = $del_man"))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Удалено!</strong> Ваша запись успешно удалена.
                    </div>";
        }
    }
}

function del_row() {
    if (isset($_POST['del_row'])) {
        $del_row = $_POST['del_row_id'];
        if (!mysql_query("DELETE FROM certificate WHERE id = $del_row"))
            echo "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            echo "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Удалено!</strong> Ваша запись успешно удалена.
                    </div>";
        }
    }
}
?>