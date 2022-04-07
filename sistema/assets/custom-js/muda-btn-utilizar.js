
$('.btn-utilizar').click(function() {
    $(this).toggleClass('btn-success');
    $(this).toggleClass('btn-danger');
});

$(document).ready(function(){
    $(".btn-utilizar").click(function(){
        $(this).text($(this).text() == 'Utilizar' ? 'Desutilizar' : 'Utilizar');
    });
});
        