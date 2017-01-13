<?php

namespace Omnipay\Adyen;

class Gateway extends \Omnipay\Common\AbstractGateway {

    public function getName() {
        return 'Adyen';
    }

    public function getDefaultParameters() {
        return [
            'testMode'        => true,
            'secret'          => '',
            'sessionLifetime' => '',
            'merchantAccount' => '',
            'skinCode'        => '',
            'daysToShipping'  => '10',
        ];
    }

    public function getSessionLifetime() {
        return $this->getParameter('sessionLifetime');
    }

    public function setSessionLifetime($value) {
        return $this->setParameter('sessionLifetime', $value);
    }

    public function getMerchantAccount() {
        return $this->getParameter('merchantAccount');
    }

    public function setMerchantAccount($value) {
        return $this->setParameter('merchantAccount', $value);
    }

    public function getSkinCode() {
        return $this->getParameter('skinCode');
    }

    public function setSkinCode($value) {
        return $this->setParameter('skinCode', $value);
    }

    public function getSecret() {
        return $this->getParameter('secret');
    }

    public function setSecret($value) {
        return $this->setParameter('secret', $value);
    }

    public function purchase(array $parameters = []) {
        return $this->createRequest('AdyenPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = []) {
        return $this->createRequest('AdyenCompletePurchaseRequest', $parameters);
    }

    /**
     * Send the request with specified data.
     * Adyen is a Off-site gateway - No need to send request, instead we need to redirect customer to Adyen site
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data) {
        return $this->response = new PurchasNeResponse($this, $data);
    }
}
