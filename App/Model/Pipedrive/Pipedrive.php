<?php
namespace App\Model\Pipedrive;

use App\Model\Pipedrive\Deal;
use App\Model\Pipedrive\Person;
use App\Model\User\PreCadastroClientePipedrive;
use App\Model\Email\Pipedrive\PendenciaPerson;
use App\Model\Email\Pipedrive\PendenciaClienteExistente;
use App\Model\Email\Pipedrive\PendenciaErroBanco;
use App\DAO\PersonPendenciaDAO;

class Pipedrive
{
    public function verificaPersonPendenciaScript($personArray)
    {
        $person = new Person();

        $pendenciaDao = new PersonPendenciaDAO();

        if ($personArray['won_deals_count'] > 0) {
            $personId = $personArray['id'];

            $personResultado = $person->getPerson($personId);

            if ($personResultado == false) {
                $personCamposVazios = $person->getCamposVazios();

                $personObj = $person->getPersonObj();

                $pendenciaPerson = new PendenciaPerson(
                    $personObj->data->owner_id->name,
                    $personObj->data->owner_id->email,
                    $personObj->data->name,
                    $personCamposVazios
                );

                $retornoPendencias = $pendenciaPerson->enviaEmailPendencias();

                if ($retornoPendencias == true) {
                    $pendenciaDao->setPendencia($personId, '', 0, 'CAMPOS_VAZIOS');
                } else {
                    $pendenciaDao->setPendencia($personId, $retornoPendencias, 0, 'CAMPOS_VAZIOS');
                }
            } else {
                $personConverter = new PersonConverter($personResultado);

                $clienteConvertido = $personConverter->converterPersonToCliente();

                $preCadastroClientePipedrive = PreCadastroClientePipedrive::getInstance($clienteConvertido);

                $isPreCadatroExistente = $preCadastroClientePipedrive->isPrecadastroExistente();

                if ($isPreCadatroExistente == true) {
                    //envia email informando que o cpf já existe, para o vendedor verificar;
                    $pendenciaClienteExistente = new PendenciaClienteExistente(
                        $personResultado->data->owner_id->name,
                        $personResultado->data->owner_id->email,
                        $personResultado->data->name
                    );

                    $pendenciaClienteExistente->enviaEmailPendencias();
                    $pendenciaDao->setPendencia($personId, '', 0, 'CLIENTE_EXISTENTE');
                    return;
                }

                $resultadoInsercao = $preCadastroClientePipedrive->convertClientePipedriveToCliente();

                if ($resultadoInsercao == false) {
                    $pendenciaDao->setPendencia($personId, '', 0, 'ERRO_BANCO', 1);
                    return;
                }

                $person->setSincronizadoPerson($personId);

                //Aqui já deu tudo certo, só verificar se deu certo de primeira, ou se deu certo depois de sanada as pendências
                if ($pendenciaDao->isPendenciaExistente($personId) == false) {
                    return;
                }

                //Aqui se a pendência existe, ele vai marcar como finalizada
                $pendenciaDao->setPendencia($personId, '', 1, '', 1);
            }
        }
    }

    public function setDealWebhook($dealJson)
    {
        $deal = new Deal($dealJson);
        $personId = $deal->getDealJson()->current->person_id;

        $pendenciaDao = new PersonPendenciaDAO();

        $person = new Person();
        $isPersonEnable = $person->isPersonEnable($personId);

        if ($deal->isWonDeal() && $isPersonEnable == true) {
        // if (true) {
            $personResultado = $person->getPerson($personId);

            if ($personResultado == false) {
                $personCamposVazios = $person->getCamposVazios();

                $personObj = $person->getPersonObj();

                $pendenciaPerson = new PendenciaPerson(
                    $personObj->data->owner_id->name,
                    $personObj->data->owner_id->email,
                    $personObj->data->name,
                    $personCamposVazios
                );

                $retornoPendencias = $pendenciaPerson->enviaEmailPendencias();

                if ($retornoPendencias == true) {
                    $pendenciaDao->setPendencia($personId, '', 0, 'CAMPOS_VAZIOS');
                } else {
                    $pendenciaDao->setPendencia($personId, $retornoPendencias, 0, 'CAMPOS_VAZIOS');
                }
            } else {
                $personConverter = new PersonConverter($personResultado);

                $clienteConvertido = $personConverter->converterPersonToCliente();

                $preCadastroClientePipedrive = PreCadastroClientePipedrive::getInstance($clienteConvertido);

                $isPreCadatroExistente = $preCadastroClientePipedrive->isPrecadastroExistente();

                if ($isPreCadatroExistente == true) {
                    //envia email informando que o cpf já existe, para o vendedor verificar;
                    $pendenciaClienteExistente = new PendenciaClienteExistente(
                        $personResultado->data->owner_id->name,
                        $personResultado->data->owner_id->email,
                        $personResultado->data->name
                    );

                    $pendenciaClienteExistente->enviaEmailPendencias();

                    $pendenciaDao->setPendencia($personId, '', 0, 'CLIENTE_EXISTENTE');
                    return;
                }

                $resultadoInsercao = $preCadastroClientePipedrive->convertClientePipedriveToCliente();

                if ($resultadoInsercao == false) {
                    $pendenciaErroBanco = new PendenciaErroBanco(
                        $personResultado->data->owner_id->name,
                        $personResultado->data->owner_id->email,
                        $personResultado->data->name
                    );

                    $pendenciaErroBanco->enviaEmailPendencias();

                    $pendenciaDao->setPendencia($personId, '', 0, 'ERRO_BANCO', 1);
                    return;
                }

                $person->setSincronizadoPerson($personId);

                //Aqui já deu tudo certo, só verificar se deu certo de primeira, ou se deu certo depois de sanada as pendências
                if ($pendenciaDao->isPendenciaExistente($personId) == false) {
                    return;
                }

                //Aqui se a pendência existe, ele vai marcar como finalizada
                $pendenciaDao->setPendencia($personId, '', 1, '', 1);

                // $nomeArquivo = uniqid();
                // file_put_contents('/var/www/html/logs/deucerto.txt', print_r($retorno, true));
            }
        }
    }
}
