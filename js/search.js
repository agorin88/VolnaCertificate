$(function() {
    $(".search_button").click(function() {
        // получаем то, что написал пользователь
        var searchString    = $("#search_box").val();
        // формируем строку запроса
        var data            = 'search='+ searchString;

        // если searchString не пустая
        if(searchString) {
            // делаем ajax запрос
            $.ajax({
                type: "POST",
                url: "../pages/do-search.php",
                data: data,
                beforeSend: function(html) { // запустится до вызова запроса
                    $("#table-header").empty();
                    $("#table-header").html('Результаты поиска');
                    $("#results").empty();
                    $("#results").html('');
                    $("#searchresults").show();
                    $(".word").html(searchString);

                },
                success: function(html){ // запустится после получения результатов
                    $("#results").show();
                    $("#results").append(html);
                }
            });
        }
        return false;
    });
});
