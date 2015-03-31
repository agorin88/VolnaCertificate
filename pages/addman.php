<? include_once ('../core.php'); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Remote file for Bootstrap Modal</title>
    </head>
<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Добавить производителя</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
<!-- Список производителей и форма добавления нового-->
    <div class="well well-list">
    <ul class="list-output">
    <?php
    foreach ($result_man as $row):
        echo "<li>
                <form method='post'>

                    <input type='hidden' name='del_man_id' value='".$row{'id'}."'/>
                    <button type='submit' name='delman' id='delman' class='btn btn-round btn-sm btn-danger'>&times;</button>
                    ".$row{'name'}."

                    </form>
              </li>";
    endforeach
    ?>
</ul>
</div>
    <div class="form-add">
        <form method="post" id="add_manufacturer">
            <div class="form-group">
                <label for="inputMan">Производитель</label>
                <input class="form-control" id="inputMan" name="man_name" type="text">
            </div>
            <div class="form-group">
                <label for="inputInfo">Комментарии(адрес, телефон, доп.информация)</label>
                <input class="form-control" id="inputInfo" name="man_info" type="text">
            </div>
            <div class="form-group form-inline">
                <button type="reset" class="btn btn-info hvr-fade hvr-shadow"><i class="fa fa-eraser"></i> Сбросить</button>
                <button type="submit" name="subman" class="btn btn-success hvr-shadow hvr-fade"><i class="fa fa-plus-circle"></i> Добавить</button>
            </div>
        </form>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
    <button type="button" class="btn btn-primary">Добавить</button>
</div>
<?php
add_cat();
del_cat();
add_man();
del_man();
?>
</body>
</html>
