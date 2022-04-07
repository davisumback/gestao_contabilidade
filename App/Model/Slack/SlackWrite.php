<?php
namespace App\Model\Slack;

class SlackWrite
{
    private $method;
    private $slackConfig;

    public function __construct()
    {
        $this->slackConfig = new \App\Config\SlackConfig();
        $this->method = 'chat.postMessage';
    }

    public function sendMessage($attachments, $channel)
    {
        if ($this->slackConfig->getAtivo() != 1) {
            return;
        }
        
        $url = $this->slackConfig->getUrl() . '/' . $this->method;
        $ch = curl_init($url);

        $data =  json_encode(array(
                    "channel"       =>  $channel,
                    "attachments"   =>  $attachments,
                ), JSON_UNESCAPED_UNICODE);

        curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
                    "Authorization: Bearer " .  $this->slackConfig->getToken(),         
                    "Content-Length: " . strlen($data),
                    "Content-Type: application/json; charset=utf-8"
            )
        );

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}