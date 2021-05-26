<?php
namespace app\service;

class CurrencyGetterClient extends Service
{
    public function requestForGetCurrency(): array
    {
        try {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => 'https://www.cbr-xml-daily.ru/daily_json.js',
                CURLOPT_RETURNTRANSFER => 1,
//            CURLOPT_FOLLOWLOCATION => 1,
//            CURLOPT_VERBOSE        => 1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER     => [
                    'Content-Type: application/json',
                    'Connection: Keep-Alive'
                ],
            ]);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('Curl error');
            }

            $info = curl_getinfo($ch);
            if (empty($info['http_code']) || $info['http_code'] != 200) {
                throw new \Exception('Currency Response: [' . json_encode($info) . '], response: ' . $response);
            }
        } finally {
            curl_close($ch);
        }

        return json_decode($response, true);
    }
}
