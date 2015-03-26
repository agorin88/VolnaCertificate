<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        //$('[data-toggle="modal"]').modal();
    })
</script>
<div class="loading">
    <div class="modal fade" id="edit_modal" role="dialog" tabindex="-1" aria-labelledby="edit_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit_label">Редактирование записи</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="inputCat">Категория</label>
                            <input id="inputCat" name="cat_id" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputMan">Производитель</label>
                            <input id="inputMan" name="man_id" type="text" class="form-control">
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
                            <label for="inputDateStart" class="labelDate">Дата регистрации</label>
                            <input class="form-control inputDate" type="date" name="date_start" id="inputDateStart">

                            <label for="inputDateEnd" class="labelDate">Действителен до</label>
                            <input class="form-control inputDate" type="date" name="date_end" id="inputDateEnd">
                        </div>
                        <div class="form-group">
                            <label for="inputCertCenter">Кем выдан</label>
                            <input class="form-control" type="text" id="inputCertCenter" name="cert_center" placeholder="Организация, выдавшая сертификат">
                        </div>
                        <div class="form-group">
                            <label for="inputUrl">Ссылка на документ</label>
                            <input class="form-control" type="url" id="inputUrl" name="photo_url" placeholder="Введите ссылку">
                        </div>
                        <button type="reset" class="btn btn-info hvr-fade hvr-shadow"><i class="fa fa-eraser"></i> Сбросить</button> <button type="submit" name="submit" class="btn btn-success hvr-shadow hvr-fade"><i class="fa fa-plus-circle"></i> Добавить</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-10 center-block fnone" >
    <form>
        <div id="searchresults" class="fnone">Результаты для <span class="word"></span></div>
        <table class="table table-hover table-bordered main-table">
            <thead>
            <tr>
                <th><i class="fa fa-times"></i></th>
                <th><input type="checkbox" id="check-all"></th>
                <th><i class="fa fa-edit" title="Изменить"></i></th>
                <th class="">#</th>
                <th>Производитель</th>
                <th>Наименование</th>
                <th>Номер сертификата</th>
                <th>Дата регистрации</th>
                <th>Дата окончания</th>
                <th>Кем выдан</th>
                <th>Посмотреть сертификат</th>
            </tr>
            </thead>
            <tbody id="results" class="update">
            <?php
            $c_date = date('Y\-m\-d');
            while ($row = mysql_fetch_array($outdate)) {
                if ($row{'date_end'} == '0000-00-00')
                    $date_end = 'Бессрочно';
                else
                    $date_end = $row{'date_end'};
                //Проверка даты истечения
                if ($row{'date_end'}<$c_date and $row{'date_end'}!='0000-00-00')
                    $date_end = '<span class="outdate" title="Внимание! Дата этого сертификата истекла.">'.$row{'date_end'}.'</span>';
                if ($row{'link'} == '')
                    $link = "<td><i class=\"fa fa-close\"></i> Изображение отсутствует</td>";
                else
                    $link = "<td><a href=\"" . $row{'link'} . "\" target=\"_blank\"><i class=\"fa fa-file\"></i> Посмотреть сертификат</a></td>";
                echo "
                      <tr>
                            <td>
                                <form method='post'>
                                    <input type=\"hidden\" name=\"del_row_id\" value=\"".$row{'id'}." \"/>
                                    <button type=\"submit\" name=\"del_row\" class='btn btn-round2 btn-sm btn-danger'>&times;</button>
                                </form>
                            </td>
                            <td><input type='checkbox' class='check-row' id='check-" . $row{'id'} . "'></td>
                            <td><button type=\"button\" class=\"btn btn-".$row{'id'}." btn-modal\" data-toggle=\"modal\" data-target=\"edit_modal\" data-rowid=\"".addslashes($row{'id'})."\"><i class=\"fa fa-edit\"</button> </td>
                            <td>" . $row{'id'} . "</td>
                            <td>" . $row{'manname'} . "</td>
                            <td>" . $row{'name'} . "</td>
                            <td>" . $row{'number'} . "</td>
                            <td>" . $row{'date_start'} . "</td>
                            <td>" . $date_end . "</td>
                            <td>" . $row{'cert_center'} . "</td>"
                    . $link .
                    "</tr>
                      ";
            }
            ?>
            </tbody>
        </table>
    </form>
    <script>
        $('#check-all').hover(function() {
            if ($(this).is(':checked')) {
                $('#check-all').prop('title', 'Снять выделение');
            } else
            {
                $('#check-all').prop('title', 'Выделить всё');
            }
        });
    </script>
    <script>
        $('#check-all').change(function () {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', true);
                //$('.tooltip-inner').html('Снять выделение');
            } else {
                checkboxes.prop('checked', false);
                //$('.tooltip-inner').html('Выделить всё');
            }
        });
    </script>

    <?php
    del_row();
    ?>



    <script>
        $('#edit_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var rowid = button.data('rowid') // Extract info from data-* attributes

            var modal = $(this)
            modal.find('.modal-title').text('Редактирование записи ' + rowid)
            //modal.find('.').val(rowid)
        })
    </script>
    <script>
        $('.btn-modal').click(function () {
            $('#edit_modal').modal({
                show: true
            })
        });
    </script>