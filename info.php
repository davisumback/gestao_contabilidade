<?php
// $data = array(
//   'email' => 'contato@medb.com.br',
//   'password' => 'medb1015'
// );

use App\Config\Pipedrive\ApiPipedriveConfig;
use Devio\Pipedrive\Pipedrive;

require_once 'vendor/autoload.php';

echo ApiPipedriveConfig::TOKEN;

$token = ApiPipedriveConfig::TOKEN;
$pipedrive = new Pipedrive($token);
$persons = $pipedrive->persons()->find(5);

echo '<pre>';
// print_r(json_encode$persons->getContent());
echo '<pre>';


// $data = array(
//   'email' => 'tthiagogaia@gmail.com',
//   'password' => 'medb1015'
// );
// $url = 'https://companydomain.pipedrive.com/v1/authorizations';
//
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//
// echo 'Sending request...' . PHP_EOL;
//
// $output = curl_exec($ch);
// curl_close($ch);
//
// $result = json_decode($output, true);
//
// echo '<pre>';
// print_r($result);
// echo '</pre>';
//
// if (!empty($result['data'][0]['api_token'])) {
//     echo 'User api_token is: ' . $result['data'][0]['api_token'] . PHP_EOL;
// }
