<?php
namespace App\Controller;

use App\Model\Os\OrdemDeServico;
use App\Model\Os\TipoOrdemDeServico;
use App\View\Os\OrdemDeServicoView;

class OrdemServicoController
{
    private $attributes;

    public function __construct($request)
    {
        $this->attributes = $request;
        $metodo = $request['method'];
        $this->$metodo($request);
    }

    /**
    * Display a listing of the resource.
    */
    public function index($request)
    {
        $os = new OrdemDeServico();

        $todasOs = $os->getAll($request);

        $tiposOs = new TipoOrdemDeServico();
        $todosTiposOs = $tiposOs->getAll();

        // Colocar aqui o getTituloTipo();

        $view = new OrdemDeServicoView();
        $request['usuariosId'] = (array_key_exists('id_usuario', $_SESSION)) ? $_SESSION['id_usuario'] : null;
        $view->show($todasOs, $todosTiposOs, $request, $tiposOs);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store($request)
    {
        echo '<pre>';
print_r($request);
echo '</pre>';
        echo 'aqui';
        die();
    }

    /**
    * Display the specified resource.
    */
    public function show()
    {

    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit()
    {

    }

    /**
    * Update the specified resource in storage.
    */
    public function update()
    {

    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy()
    {

    }
}