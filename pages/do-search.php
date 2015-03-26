<?php
//получаем данные через $_POST
if (isset($_POST['search'])) {
    // подключаемся к базе
    include('../core.php');
    $db = new db();
    // никогда не доверяйте входящим данным! Фильтруйте всё!
    $word = mysql_real_escape_string($_POST['search']);
    // Строим запрос
    $sql = "SELECT
            certificate.id,
            certificate.name,
            certificate.number,
            certificate.date_end,
            certificate.date_start,
            certificate.cert_center,
            certificate.photo_url AS 'link',
            man.name as 'manname'
            FROM certificate
            LEFT JOIN man ON man.id = certificate.man_id
            WHERE certificate.name LIKE '%" . $word . "%'
            LIMIT 50";
    // Получаем результаты
    $row = $db->select_list($sql);
    if (count($row)) {
        $end_result = '';
        foreach ($row as $r) {
             //обявляем и заполняем переменные
            $rid = $r['id'];
            $rmid = $r['manname'];
            $rname = $r['name'];
            $rnumber = $r['number'];
            $rdstart = $r['date_start'];
            $rccenter = $r['cert_center'];
            //проверка даты и проверка ссылки. Если пустые - заменяем
            if ($r['date_end'] == '0000-00-00')
                $rdend = 'Бессрочно';
            else
                $rdend = $r['date_end'];

            if ($r['link'] == '')
                $rurl = "<td><i class=\"fa fa-close\"></i> Изображение отсутствует</td>";
            else
                $rurl = "<td><a href=\"" . $r['link'] . "\" target=\"_blank\"><i class=\"fa fa-file\"></i> Посмотреть сертификат</a></td>";

            //записываем промежуточный результат в виде таблицы
            $temp .= "<tr>
                            <td>
                                <form method='post'>
                                    <input type=\"hidden\" name=\"del_row_id\" value=\"".$rid." \"/>
                                    <button type=\"submit\" name=\"del_row\" class='btn btn-round2 btn-sm btn-danger'>&times;</button>
                                </form>
                            </td>
                            <td><input type='checkbox' class='check-row' id='check-" . $rid . "'></td>
                            <td><button type=\"button\" class=\"btn btn-".$rid." btn-modal\" data-toggle=\"modal\" data-target=\"edit_modal\" data-rowid=\"".addslashes($rid)."\"><i class=\"fa fa-edit\"</button> </td>
                            <td>" . $rid . "</td>
                            <td>" . $rmid . "</td>
                            <td>" . $rname . "</td>
                            <td>" . $rnumber . "</td>
                            <td>" . $rdstart . "</td>
                            <td>" . $rdend . "</td>
                            <td>" . $rccenter . "</td>"
                            . $rurl .
                        "</tr>";
        }
        echo $temp;
    } else {
        echo '<span>По вашему запросу ничего не найдено</span>';
    }
}
?>
