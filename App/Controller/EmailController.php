<?php
namespace App\Controller;

class EmailController
{
   private $attributes;

   public function setAttributes($attributes)
   {
      if (empty($attributes)) {
         throw new \Exception("Reenvio de e-mail sem parametros!", 1);
      }
      $this->attributes = $attributes;
   }

   public function reenvioEmail()
   {
      $empresasId = $this->attributes['empresasId'];
      $competencia = $this->attributes['competencia'];

      $empresa = new \App\Model\Empresa\Empresa();
      $empresa->isEmpresa($empresasId);
      $empresa->isEmailGuiaEnviado($empresasId, $competencia);

      $empresaEmailDao = new \App\DAO\EmpresaEmailDAO();
      $empresaEmail = $empresaEmailDao->getEmpresaEmail($empresasId);

      $vinculo = $empresaEmail[0]['vinculo'];
      $emails = array();

      foreach ($empresaEmail as $empresa) {
         $emails[] = $empresa['email'];
      }

      $guiaDao = new \App\DAO\GuiaDAO();

      if ($vinculo == 'MEDB') {
         $guiaMes = new \App\System\EnviaGuiasMesNovo($guiaDao, $empresaEmail[0], $competencia);
         $guias = $guiaDao->getNomeGuiasAnexo($competencia, $empresasId);
         $templateEmail = new \App\Email\TemplateEmailGuias($empresaEmail[0]['nome_completo'], $guias);
         $resultado = $guiaMes->enviaEmail($templateEmail->getCorpoEmail(), $emails);

      } else {
         $guiaMes = new \App\System\EnviaGuiasMedcontabil($guiaDao, $empresaEmail[0], $competencia);
         $guias = $guiaDao->getNomeGuiasAnexo($competencia, $empresasId);
         $templateEmail = new \App\Email\TemplateEmailGuiasMedcontabil($empresaEmail[0]['nome_completo'], $guias);
         $resultado = $guiaMes->enviaEmail($templateEmail->getCorpoEmail(), $emails);
      }

      if ($resultado) {
         $empresaGuiaDao = new \App\DAO\EmpresaGuiaEmailDAO();
         $empresaGuiaDao->updateReenvioEmailGuia($competencia, $empresasId);
      }

      return 'Sucesso ao reenviar o e-mail.';
   }
}