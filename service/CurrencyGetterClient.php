<?php
namespace app\service;

class CurrencyGetterClient extends Service
{
    /**
     * @return array [['USD': ['Name' => {string}, 'Value' => {float} ]],]
     * @throws \Exception
     */
    public function requestForGetCurrency(): array
    {
        $result = null;
        try {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => 'https://www.cbr-xml-daily.ru/daily_json.js',
                CURLOPT_RETURNTRANSFER => 1,
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

            $result = json_decode($response, true);
            $info = curl_getinfo($ch);
            if (empty($info['http_code']) || $info['http_code'] != 200 || !is_array($result)) {
                throw new \Exception('Currency Response: [' . json_encode($info) . '], response: ' . $response);
            }
        } finally {
            curl_close($ch);
        }

        return $result['Valute'];
    }
}
