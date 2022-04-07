<?php

namespace App\View;

class MenuN {
    private $itensMenu = array();

    public function setItemMenu($menu){
        array_push($this->itensMenu, $menu);
    }

    public function getItensMenu(){
        $saida = '';

        foreach ($this->itensMenu as $itemMenu) {
            $saida .= $itemMenu;
        }

        return $saida;
    }

}
