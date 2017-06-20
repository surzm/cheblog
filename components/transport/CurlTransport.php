<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 13.06.17
 * Time: 16:28
 */

namespace app\components\transport;

use app\components\api\ApiParamsInterface;

class CurlTransport implements TransportInterface
{

    private $response;

    public function __construct(ApiParamsInterface $params)
    {
        $this->init($params);
    }

    private function init($params)
    {

        $headers_i = [];
        /** @var ApiParamsInterface $params */
        $headers_i[] = "Content-type: " . $params->getContentType();
        $headers_i = array_merge($headers_i, $params->getHeaders());
        $ch = curl_init($params->getUrl());
        if ($params->getData()) curl_setopt($ch, CURLOPT_POSTFIELDS, $params->getData());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $params->getMethod());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_i);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);


        $response = curl_exec($ch);
        curl_close($ch);
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

}