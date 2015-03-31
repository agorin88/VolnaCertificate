/**
 * Created by Andrew on 27.03.2015.
 */

function alertTimeout(wait){
    setTimeout(function(){
        $('#queryRes').children('.alert:first-child').fadeOut(1000);
    }, wait);
}
function alertRemove(){
    $('#queryRes').children('.alert:first-child').remove();
}