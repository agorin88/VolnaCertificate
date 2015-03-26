<h1 class="header-h1 fleft col-md-5">Добавить категорию</h1>
<ul class="list-output fleft col-md-5">
    <?php
    while ($row = mysql_fetch_array($result_cat2)) {
        echo "<li>";
        echo "<form method=\"post\">";
        echo "<input type=\"hidden\" name=\"del_cat_id\" value=\"".$row{'id'}." \">";
        echo "<button type=\"submit\" name=\"delete\" id=\"delete\" class=\"btn btn-round btn-sm btn-danger\">".
        "&times;".
            "</button> ".$row{'name'};
        echo "</form>";
        echo "</li>";
    }
    ?>
</ul>

<div class="form-add col-md-5 fnone">
    <form method="post" id="add_category">
        <div class="form-group">
            <label for="inputCat">Категория</label>
            <input class="form-control" type="text" id="inputCat" name="cat_name">
        </div>

        <button type="reset" class="btn btn-info hvr-fade hvr-shadow"><i class="fa fa-eraser"></i> Сбросить</button>
        <button type="submit" name="submit" id="sub_cat" class="btn btn-success hvr-shadow hvr-fade"><i class="fa fa-plus-circle"></i> Добавить
        </button>
    </form>
</div>

<!-- Список производителей и форма добавления нового-->
<br/>
<h1 class="header-h1 fleft col-md-5">Добавить Производителя</h1>
<ul class="list-output fleft col-md-5">
    <?php
    while ($row = mysql_fetch_array($result_man)) {
        echo "<li>";
        echo '<form method="post">';
        echo "<input type=\"hidden\" name=\"del_man_id\" value=\"".$row{'id'}." \"/>";
        echo '<button type="submit" name="delman" id="delman" class="btn btn-round btn-sm btn-danger">&times;</button> '.$row{'name'};
        echo "</form>";
        echo "</li>";
    }
    ?>
</ul>
<div class="form-add col-md-5 fnone">
    <form method="post" id="add_manufacturer">
        <div class="form-group">
            <label for="inputMan">Производитель</label>
            <input class="form-control" id="inputMan" name="man_name" type="text">
        </div>
        <div class="form-group">
            <label for="inputInfo">Комментарии(адрес, телефон, доп.информация)</label>
            <input class="form-control" id="inputInfo" name="man_info" type="text">
        </div>
        <button type="reset" class="btn btn-info hvr-fade hvr-shadow"><i class="fa fa-eraser"></i> Сбросить</button>
        <button type="submit" name="subman" class="btn btn-success hvr-shadow hvr-fade"><i class="fa fa-plus-circle"></i> Добавить</button>
    </form>
</div>
<?php
add_cat();
del_cat();
add_man();
del_man();
?>

