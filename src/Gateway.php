<?php

namespace Omnipay\Adyen;

class Gateway extends \Omnipay\Common\AbstractGateway {

    /**
     * @return string
     */
    public function getName() {
        return 'Adyen';
    }

    /**
     * @return array
     */
    public function getDefaultParameters() {
        return [
            'secret'          => '',
            'sessionLifetime' => '',
            'merchantAccount' => '',
            'skinCode'        => '',
            'daysToShipping'  => '10',
        ];
    }

    /**
     * @return string|null
     */
    public function getSessionLifetime() {
        return $this->getParameter('sessionLifetime');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setSessionLifetime($value) {
        return $this->setParameter('sessionLifetime', $value);
    }

    /**
     * @return string|null
     */
    public function getMerchantAccount() {
        return $this->getParameter('merchantAccount');
    }

    public function setMerchantAccount($value) {
        return $this->setParameter('merchantAccount', $value);
    }

    /**
     * @return string|null
     */
    public function getSkinCode() {
        return $this->getParameter('skinCode');
    }

    public function setSkinCode($value) {
        return $this->setParameter('skinCode', $value);
    }

    /**
     * @return string|null
     */
    public function getSecret() {
        return $this->getParameter('secret');
    }

    public function setSecret($value) {
        return $this->setParameter('secret', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Adyen\Message\PurchaseRequest
     */
    public function purchase(array $parameters = []) {
        return $this->createRequest('Omnipay\Adyen\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Adyen\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = []) {
        return $this->createRequest('Omnipay\Adyen\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Adyen\Message\FetchPaymentMethodsRequest
     */
    public function fetchPaymentMethods(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Adyen\Message\FetchPaymentMethodsRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Adyen\Message\FetchIssuersRequest
     */
    public function fetchIssuers(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Adyen\Message\FetchIssuersRequest', $parameters);
    }
}
