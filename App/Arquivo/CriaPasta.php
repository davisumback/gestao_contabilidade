<?php

namespace App\Arquivo;

class CriaPasta
{
    public function criaPasta($nomePasta)
    {
        $oldmask = umask(0);
        $retorno = mkdir($nomePasta, 0777);
        umask($oldmask);

        return $retorno;
    }
}

