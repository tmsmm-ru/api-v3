<?php

class TmSMMApiV3
{
    private $uriAPI = 'https://tmsmm.ru/api/v3/';
    private $token;

    public function __construct($token)
    {
        if (empty($token)) {
            throw new \Exception('Empty token.');
        }

        $this->token = $token;
    }

    public function getProfile()
    {
        return $this->_api('GET', 'profile');
    }

    public function create($data)
    {
        return $this->_api('POST', 'social', $data);
    }

    public function status($id)
    {
        return $this->_api('GET', 'social/' . $id);
    }

    private function _api($customRequest, $url = '', $params = [])
    {
        $uri = $this->uriAPI . $url . '?token=' . $this->token;

        return $this->_checkResponse(
            $this->_curl($uri, $params, $customRequest)
        );
    }

    private function _checkResponse($response)
    {
        if (empty($response)) {
            throw new \Exception('Empty response.');
        }

        $data = json_decode($response, true);

        if (json_last_error()) {
            echo $response . PHP_EOL;

            throw new \Exception('Error json decode.');
        }

        return $data;
    }

    private function _curl($uri, $params = [], $customRequest = 'GET')
    {
        $curl = curl_init($uri);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $customRequest);

        if (! empty($params)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}

try {
    $token = ''; // token

    $oTmSMM = new TmSMMApiV3($token);

    // ...
} catch (\Exception $e) {
    echo $e->getMessage();
}
