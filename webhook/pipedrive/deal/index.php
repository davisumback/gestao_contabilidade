<?php
use App\Model\Pipedrive\Pipedrive;

require_once '../../../vendor/autoload.php';

$entrada = file_get_contents('php://input');

$pipedrive = new Pipedrive();
$pipedrive->setDealWebhook($entrada);
