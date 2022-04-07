<?php

namespace App\View;

class MenuLeft {
    private $titulo;
    private $itens_menu = array();
    private $menu;

    function __construct(){}

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($nome_titulo){
        $titulo = "<h3 class=\"menu-title\">$nome_titulo</h3>";
        $this->titulo = $titulo;
    }

    public function setMenu($class){
        $titulo = $this->getTitulo();
        // $this->menu = "$titulo<li class=\"$class\">";
        $this->menu = "$titulo<li class=\"$class\">";
    }

    public function getMenu(){
        $menu = $this->menu;
        foreach ($this->itens_menu as $item) {
            $menu .= $item;
        }
        $menu .= "</li>";

        return $menu;
    }

    public function setIconItemMenu($nome, $class_icon){
        $icon = "<i class=\"$class_icon\"></i>$nome";

        return $icon;
    }

    public function setItemMenu($caminho, $nome, $class_icon){
        $icon = $this->setIconItemMenu($nome, $class_icon);
        $item_menu = " <a href=\"$caminho\" class=\"gif-loading\"> $icon </a>";

        array_push($this->itens_menu, $item_menu);
    }
}
