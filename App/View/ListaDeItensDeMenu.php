<?php

namespace App\View;

class ListaDeItensDeMenu{
    private $itensMenuDropDown = array();
    private $itensMenuSimples = array();
    private $menuLiDropDown;
    private $menuSimples;

    public function setMenuSimmples($classMenuSimples){
        $menuSimples = "<li class=\"$classMenuSimples\">";
        foreach ($this->itensMenuSimples as $item) {
            $menuSimples .= $item;
        }
        $menuSimples .= "</li>";

        $this->menuSimples = $menuSimples;
    }

    public function getMenuSimples(){
        return $this->menuSimples;
    }

    public function setCategoriaMenu($nome){
        return "<h3 class=\"menu-title\">$nome</h3>";
    }

    public function setCategoriaMenuMedcontabil($nome){
        return "<h3 class=\"menu-title border-light\">$nome</h3>";
    }


    public function setItemMenuSimples($caminho, $classIconeI, $nome, $id = null)
    {   
        if ($id != null) {
            $item = " <a href=\"$caminho\" class=\"gif-loading py-1\" id=\"$id\"> <i class=\"$classIconeI\"></i>$nome</a>";    
        } else {
            $item = " <a href=\"$caminho\" class=\"gif-loading py-1\"> <i class=\"$classIconeI\"></i>$nome</a>";
        }
        $this->itensMenuSimples[] = $item;
    }

    public function setMenuLiDropDown($nome, $caminho, $classIconeI){
        $li =
        "<li class=\"menu-item-has-children dropdown\">".$this->setTituloMenuLi($nome, $caminho, $classIconeI).$this->setDropdownMenu()."</li>";

        $this->menuLiDropDown = $li;
    }

    public function getMenuLiDropDown(){
        return $this->menuLiDropDown;
    }

    public function setTituloMenuLi($nome, $caminho, $classIconeI){
        $a = "<a href=\"$caminho\" class=\"dropdown-toggle py-1\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\"> <i class=\"$classIconeI\"></i>$nome</a>";
        return $a;
    }

    public function setDropdownMenu(){
        $menuDropDown = "<ul class=\"sub-menu children dropdown-menu\">";

        foreach ($this->itensMenuDropDown as $item){
            $menuDropDown .= $item;
        }
        $menuDropDown .= "</ul>";

        return $menuDropDown;
    }

    public function setItemDropDownMenu($classElementoI, $caminhoElementoA, $nomeMenu){
        $itemMenu = "<li><i class=\"$classElementoI\"></i><a href=\"$caminhoElementoA\" class=\"gif-loading\">$nomeMenu</a></li>";
        $this->itensMenuDropDown[] = $itemMenu;
    }
}
