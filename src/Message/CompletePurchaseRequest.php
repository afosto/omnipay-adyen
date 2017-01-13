<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest extends AbstractRequest {

    protected $merchantSigKeys = ['authResult', 'merchantReference', 'merchantReturnData', 'paymentMethod', 'pspReference', 'reason', 'shopperLocale', 'skinCode'];

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData() {
        return $this->httpRequest->query->all();
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data) {
        return new CompletePurchaseResponse($this, $data);
    }

    /**
     * Calculate the signature using the response data
     *
     * @return string
     */
    public function calculateSignature()
    {
        $signatureData = [];

        foreach ($this->merchantSigKeys as $key) {
            if ($this->httpRequest->query->has($key)) {
                $signatureData[$key] = $this->httpRequest->query->get($key);
            }
        }

        return $this->generateSignature($signatureData);
    }
}