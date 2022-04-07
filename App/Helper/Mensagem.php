<?php

namespace App\Helper;

class Mensagem{

    public static function getMensagem($cookieArray, $chaveResultado, $chaveMensagem){
        $saida = '';
        if(array_key_exists($chaveResultado, $cookieArray) && $cookieArray[$chaveResultado] == "false"){
            $saida = "<div class=\"mb-3 text-center alert alert-danger alert-dismissible fade show alert-login\" role=\"alert\">
                <strong>$_COOKIE[$chaveMensagem]</strong>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";
        } elseif(array_key_exists($chaveResultado, $cookieArray) && $cookieArray[$chaveResultado] == "true") {
            $saida = "<div class=\"mb-3 text-center alert alert-primary alert-dismissible fade show alert-login\" role=\"alert\">
                <strong>$_COOKIE[$chaveMensagem]</strong>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";
        }

        echo $saida;
    }
}
