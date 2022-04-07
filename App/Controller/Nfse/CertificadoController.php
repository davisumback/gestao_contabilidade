<?php
namespace App\Controller\Nfse;

use App\Controller\Controller;
use App\Model\Nfse\Certificado;

class CertificadoController extends Controller
{
    private $session;

    public function __construct()
    {
        session_start();
        $this->session = $_SESSION;
    }

    public function update($arquivo, $request)
    {
        $pasta = $this->session['pasta'];
        $caminho = '../../' . $pasta . '/certificado.php';

        try {
            $certificado = new Certificado();
            $certificado->setAttributes($arquivo['fileUpload'], $request['senha'], $request['dataValidade'], $request['empresasId']);
            $certificado->setIdIntegracao($request['idIntegracao']);
            $certificado->setPastaCertificado('../../../grupobfiles/empresas/' . $request['empresasId'] . '/certificados');
            $certificado->uploadCertificado();
            $certificado->save();
        } catch (\Exception $e) {
            $this->redirectErro('insercaoCertificado', 'mensagemInsercaoCertificado', $e->getMessage(), $caminho);
        }

        $this->redirectSucesso('insercaoCertificado', 'mensagemInsercaoCertificado', 'Certificado alterado com sucesso.', $caminho);
    }

    public function store($arquivo, $request)
    {
        $pasta = $this->session['pasta'];
        $caminho = '../../' . $pasta . '/certificado.php';

        try {
            $certificado = new Certificado();
            $certificado->setAttributes($arquivo['fileUpload'], $request['senha'], $request['dataValidade'], $request['empresasId']);
            $certificado->setPastaCertificado('../../../grupobfiles/empresas/' . $request['empresasId'] . '/certificados');
            $certificado->uploadCertificado();
            $certificado->save();
        } catch (\Exception $e) {
            $this->redirectErro('insercaoCertificado', 'mensagemInsercaoCertificado', $e->getMessage(), $caminho);
        }

        $this->redirectSucesso('insercaoCertificado', 'mensagemInsercaoCertificado', 'Certificado salvo com sucesso.', $caminho);
    }
}