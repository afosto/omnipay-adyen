<?php

namespace Omnipay\Adyen\Message;

use Guzzle\Common\Event;
use Omnipay\Common\Message\ResponseInterface;

class FetchPaymentMethodsRequest extends AbstractRequest {

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData() {
        $this->validate('currency', 'merchantAccount', 'amount', 'skinCode', 'transactionId', 'sessionLifetime');

        $data = [];

        $data['paymentAmount'] = $this->getAmountInteger();
        $data['currencyCode'] = $this->getCurrency();
        $data['merchantReference'] = $this->getTransactionId();
        $data['skinCode'] = $this->getSkinCode();
        $data['merchantAccount'] = $this->getMerchantAccount();
        $data['sessionValidity'] = $this->getSessionValidity();
        $data['merchantSig'] = $this->generateSignature($data);

        return $data;
    }

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

        return new FetchPaymentMethodsResponse($this, $response->json());
    }
}