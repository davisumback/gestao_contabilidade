<?php

namespace App\Model\Usuario;

class Auth
{
   public function __construct()
   {
      \session_start();
   }

   public function sessionVerify()
   {
      if (isset($_SESSION['id_usuario'])) {
         $this->redirectActiveSession($_SESSION['pasta']);
      }
   }

   public function isSessioExpired()
   {
      if (!isset($_SESSION['id_usuario'])) {
         $this->redirectInativeSession();
      }
   }

   private function redirectActiveSession($pasta)
   {
      header("Location: sistema/" . $pasta . "/index.php");
      die();
   }

   public function redirectInativeSession()
   {
      setcookie('retorno_sessao', 'true', time() + 2, '/');
      setcookie('mensagem_sessao', 'É necessário realizar o login', time() + 2, '/');
      header("Location: ../../index.php");
      die();
   }
}