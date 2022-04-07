<?php
namespace App\Controller;

// use App\Controller\Controller;
// use App\Model\Empresa\UploadArquivoAlvara;

class UploadArquivoController
{
    private $attributes;
    private $files;   

    public function setAttributes($attributes, $files)
    {
        $this->attributes = $attributes;
        $this->files = $files;
    }

    public function verificaParametros()
    {
        if (empty($this->attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema diretamente!", 1);
        }
    }

    public function store()
    {
        $this->verificaParametros();

        $upload = new \App\Model\UploadArquivoModel();

        $this->attributes['files'] = $this->files['fileUpload'];
        $upload->save($this->attributes);

        return 'Sucesso ao salvar o arquivo.';
    }

    public function storeAlvara()
    {
        $this->verificaParametros();

        $upload = new \App\Model\Empresa\Alvara();

        $this->attributes['files'] = $this->files['fileUpload'];
        $upload->save($this->attributes);

        return 'Sucesso ao salvar o arquivo.';
    }

    public function storeDiversos()
    {
        $this->verificaParametros();

        $upload = new \App\Model\UploadArquivoModel();

        $this->attributes['files'] = $this->files['fileUpload'];
        $upload->saveDiversos($this->attributes);

        return 'Sucesso ao salvar o arquivo.';
    }
}