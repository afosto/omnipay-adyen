<?php

namespace Omnipay\Adyen\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest {

    protected $liveEndpoint = 'https://live.adyen.com/hpp/';
    protected $testEndpoint = 'https://test.adyen.com/hpp/';

    public function getSecret() {
        return $this->getParameter('secret');
    }

    public function setSecret($value) {
        return $this->setParameter('secret', $value);
    }

    public function getSkinCode() {
        return $this->getParameter('skinCode');
    }

    public function setSkinCode($value) {
        return $this->setParameter('skinCode', $value);
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

    public function getDaysToShipping() {
        return $this->getParameter('daysToShipping');
    }

    public function setDaysToShipping($value) {
        return $this->setParameter('daysToShipping', $value);
    }

    public function generateSignature($data) {
        // Sort the array by key using SORT_STRING order
        ksort($data, SORT_STRING);

        // Generate the signing data string
        $signData = implode(":", array_map(function ($val) {
            return str_replace(':', '\\:', str_replace('\\', '\\\\', $val));
        }, array_merge(array_keys($data), array_values($data))));

        // base64-encode the binary result of the HMAC computation
        return base64_encode(hash_hmac('sha256', $signData, pack("H*", $this->getSecret()), true));
    }

    public function getShipBeforeDate() {
        return date('c', strtotime('+' . $this->getDaysToShipping() . ' days'));
    }

    public function getSessionValidity() {
        return date('c', strtotime($this->getSessionLifetime()));
    }

    public function getEndpoint() {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
