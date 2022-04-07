<?php

define("START_DATE",        date("Y-m-d", strtotime("-2 days")));
define("END_DATE",          date("Y-m-d", strtotime("-1 days")));
define("EMAIL_NOTIFICACAO", "integracao@medcontabil.com.br");

//configuração do phpmailer
const HOST = 'smtpi.kinghost.net';
const USER_NAME = 'no-reply@medcontabil.com.br';
const SENHA = 'franquia01';
const NOME_EMAIL_DE_RESPOSTA = 'No-reply';