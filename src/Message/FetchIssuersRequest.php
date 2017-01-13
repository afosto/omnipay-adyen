<?php

namespace Omnipay\Adyen\Message;

use Guzzle\Common\Event;
use Omnipay\Common\Message\ResponseInterface;

class FetchIssuersRequest extends FetchPaymentMethodsRequest {

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data) {
        $response = $this->httpClient->post(
            $this->getEndpoint().'directory.shtml', array(), $data
        )->send();

        return new FetchIssuersResponse($this, $response->json());
    }
}