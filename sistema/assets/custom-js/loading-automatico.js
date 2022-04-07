(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation-loading');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }else{
                    mostraGifLoading();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$('.gif-loading').click(function() {
    $('#carregando').toggle();
    $('#conteudo').addClass('cor-fundo');
});

function mostraGifLoading(){
    $('#carregando').toggle();
    $('#conteudo').addClass('cor-fundo');
}

function vaiParaNovaPagina(caminho){
    mostraGifLoading();
    location.assign(caminho);
}

function vaiParaNovaAba(caminho) {
    window.open(caminho, '_blank');
}
