<!--
    --------------
    Page for adding certificate
    --------------
    Final version: 26.03.2015
-->
<!-- Modal -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="ManModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
        </div> <!-- /.modal-content -->

    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<div class="col-sm-4 col-xs-10 graph pull-right">
    <h4>Добавлений по дням:</h4>
    <div class="graph-well">
        <canvas id="graph1" height="200" width="300"></canvas>
    </div>
</div>
<div class="form-add col-sm-5 col-xs-10 pull-left">
    <form id="cert-add" method="post">
        <label for="inputCat">Категория</label>
        <div class="form-group form-inline">
            <select class="form-control" id="inputCat" name="cat_id">
                <?php
                foreach ($result_cat as $row):
                   echo "<option value=\"".$row{'id'}."\">".$row{'name'}."</option>";
                endforeach
                ?>
            </select>
            <a data-toggle="modal" class="btn btn-info" href="pages/addcat.php" data-target="#AddModal">+</a>
        </div>
        <label for="inputMan">Производитель</label>
        <div class="form-group form-inline">
            <select class="form-control" id="inputMan" name="man_id">
                <?php
                foreach ($result_man as $row):
                    echo "<option value=\"".$row{'id'}."\">".$row{'name'}."</option>";
                endforeach
                ?>
            </select>
            <a data-toggle="modal" class="btn btn-info" href="pages/addman.php" data-target="#ManModal">+</a>
        </div>
        <div class="form-group">
            <label for="inputName">Наименование</label>
            <textarea class="form-control" rows="3" id="inputName" name="cert_name" placeholder="Введите наименование сертификата"></textarea>
        </div>
        <div class="form-group">
            <label for="inputNumber">Номер сертификата</label>
            <input class="form-control" type="text" id="inputNumber" name="cert_number" placeholder="Введите номер сертификата">
        </div>


        <div class="form-group form-inline formDate">
            <div class="form-group">
                <label for="inputDateStart" class="labelDate">Дата регистрации</label>
                <input class="form-control inputDate" type="date" name="date_start" id="inputDateStart">
            </div>
            <div class="form-group">
                <label for="inputDateEnd" class="labelDate" style="display: block">Действителен до</label>
                <input class="form-control inputDate" type="date" name="date_end" id="inputDateEnd">
            </div>
        </div>
        <div class="form-group">
            <label for="inputCertCenter">Кем выдан</label>
            <input class="form-control" type="text" id="inputCertCenter" name="cert_center" placeholder="Организация, выдавшая сертификат">
        </div>
        <div class="form-group">
            <label for="inputUrl">Ссылка на документ</label>
            <input class="form-control" type="url" id="inputUrl" name="photo_url" placeholder="Введите ссылку">
        </div>
        <button type="reset" class="btn btn-info hvr-fade hvr-shadow"><i class="fa fa-eraser"></i> Сбросить</button> <button type="submit" name="submit" id="btn-submit" class="btn btn-success hvr-shadow hvr-fade"><i class="fa fa-plus-circle"></i> Добавить</button>
    </form>
</div>



<?php
//add_cert();
?>

<!-- submit row into DB by pressing Ctrl+Enter key -->
<!-- KeyCode 10 and 13: This is a cross-browser patch. Webkit use a "10" code for "Enter"-key -->
<script>
    $(function ()
    {
        $(document).on("keydown", "#cert-add", function(e)
        {
            if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey)
            {
                $("#btn-submit").click();
            }
        });
    });
</script>
<script>
    $('#cert-add').submit(function() {
        var serial = $('#cert-add').serialize();
        var url = 'pages/do-add.php';
//When element with id=submit is clicked execute this code
        $.ajax({
            type: 'POST',
            url: url,
            data: serial,
            success: function (data) {
                //this gets executed when ajax succeeds
                $("#queryRes").html(data);
                alertTimeout(3000);
                $('#inputName').val("");
                $('#inputNumber').val("");
                $('#inputDateStart').val("");
                $('#inputDateEnd').val("");
                $('#inputCertCenter').val("");
                $('#inputUrl').val("");
                graphDraw();
            }
        });
        return false;
    });
</script>

<!-- graph JS -->
<script>
    $(document).ready(function () {
        graphDraw();
    });
    function graphDraw() {
        $.getJSON("pages/graph-added.php", function (result) {
            var BarChartData = {
                labels : result[0],
                datasets: [
                    {
                        fillColor : "rgba(127,127,127,0.5)",
                        strokeColor : "rgba(0,0,0,0.3)",
                        highlightFill: "rgba(127,127,127,0.75)",
                        highlightStroke: "rgba(0,0,0,0.5)",
                        data : result[1]
                    }
                ]};
            var ctx = document.getElementById("graph1").getContext("2d");
            window.myBar = new Chart(ctx).Bar(BarChartData, {
                responsive : true,
                barStrokeWidth : 1,
                scaleShowGridLines : false,
                scaleGridLineColor : "rgba(0,0,0,1)"
            });
        });
    }

</script>