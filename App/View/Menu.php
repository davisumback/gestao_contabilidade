<?php

namespace App\View;

class Menu {
    private $menus = array();

    public function setItemMenu($menu){
        array_push($this->menus, $menu);
    }

    public function getMenus(){
        $saida = '';

        foreach ($this->menus as $menu) {
            $saida .= $menu->getMenu();
        }

        return $saida;
    }

}
