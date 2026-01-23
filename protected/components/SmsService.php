<?php

class SmsService extends CComponent
{
    private $apiKey = 'XXXXXXXXXXXXXXX'; // ключ эмулятора
    
    public function send($phone, $message)
    {
        Yii::log("SMS to {$phone}: {$message}", 'info', 'sms');
        
        // Реальная отправка через smspilot.ru
        // $url = "http://smspilot.ru/api.php";
        // $params = [...];
        // file_get_contents($url . '?' . http_build_query($params));
        
        return true;
    }
}