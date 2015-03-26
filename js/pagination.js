$(document).ready(function() {
    $("#result_table").load( "http://localhost/certificates/pages/cat.php"); //load initial records

    //executes code below when user click on pagination links
    $("#result_table").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading").show(); //show loading element
        var page = $(this).attr("data-page"); //get page number from link
        $("#result_table").load("http://localhost/certificates/pages/cat.php",{"page":page}, function(){ //get content from PHP page
            $(".loading").hide(); //once done, hide loading element
        });

    });
});