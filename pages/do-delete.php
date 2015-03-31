<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 27.03.2015
 * Time: 16:28
 */
    include ('../core.php');
    $db = new SafeMySQL();

    //if (isset($_POST['del_row'])) {
        $del_row = $_GET['delete'];
        $catid = $_GET['catid'];
        $table = "certificate";
        $sql = "DELETE FROM ?n WHERE id = ?i";
        if (!$db->query($sql, $table, $del_row))
            $resp = "<div class=\"alert alert-add alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><strong>Ошибка!</strong> Что-то пошло не так.</div>";
        else {
            $resp = "<div class=\"alert alert-add alert-success\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
                    <strong>Удалено!</strong> Ваша запись успешно удалена.
                    </div>";
            $count = $db->getAll("SELECT SQL_CALC_FOUND_ROWS * FROM ?n WHERE cat_id = ?i", $table, $catid);
            $rowcount = $db->getOne("SELECT FOUND_ROWS()");
            //$rowcount = $rowcount - 2;
        }

        echo json_encode(array("data1" => $resp, "data2" => $rowcount));
   // }

?>