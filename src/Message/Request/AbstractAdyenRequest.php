<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchPaymentMethodsResponse;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractAdyenRequest extends AbstractRequest
{

    use ApiTrait;

    const POST = 'POST';
    const GET = 'GET';

    /**
     * @param array $data
     * @return ResponseInterface|FetchPaymentMethodsResponse
     */
    public function sendData($data)
    {
        $response = $this->sendRequest($data);

        $class = $this->getResponseClass();
        return $this->response = new $class($this, $response);
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    protected function sendRequest($data = null)
    {
        $headers = [
            'Accept'       => "application/json",
            'Content-Type' => "application/json",
            'X-API-Key'    => $this->getApiKey(),
        ];


        $url = $this->getApiBaseUrl() . $this->getVersion() . $this->getEndpoint();

        $response = $this->httpClient->request(
            $this->getRequestMethod(),
            $url,
            $headers,
            ($data === null || $data === []) ? null : json_encode($data)
        );


        $data = json_decode($response->getBody(), true);

        return $data;
    }

    abstract protected function getRequestMethod();

    abstract protected function getEndpoint();

    abstract protected function getResponseClass();
}
