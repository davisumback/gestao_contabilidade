var painelDireito = document.getElementById('header');
var btnOpcaoPerfil = document.getElementById('opcao-perfil');
var btnOpcaoAlterarSenha = document.getElementById('opcao-alterar-senha');
var btnOpcaoSair = document.getElementById('opcao-sair');

function myFunction(x) {
    if (x.matches){
        painelDireito.removeAttribute('hidden');
        btnOpcaoPerfil.setAttribute('hidden','true');
        btnOpcaoAlterarSenha.setAttribute('hidden','true');
        btnOpcaoSair.setAttribute('hidden','true');
    }else{
        painelDireito.setAttribute('hidden', 'true');
        btnOpcaoPerfil.removeAttribute('hidden');
        btnOpcaoAlterarSenha.removeAttribute('hidden');
        btnOpcaoSair.removeAttribute('hidden');
    }
}

var x = window.matchMedia("(min-width: 700px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes
