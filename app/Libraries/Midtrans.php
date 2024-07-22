<?php

namespace App\Libraries;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class Midtrans
{
    public function __construct()
    {
        $config = config('Midtrans');
        Config::$serverKey = $config->serverKey;
        Config::$clientKey = $config->clientKey;
        Config::$isProduction = $config->isProduction;
        Config::$isSanitized = $config->isSanitized;
        Config::$is3ds = $config->is3ds;
    }

    public function getSnapToken($transaction_data)
    {
        return Snap::getSnapToken($transaction_data);
    }

    public function handleNotification()
    {
        return new Notification();
    }
}