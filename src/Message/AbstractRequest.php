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
        // The data that needs to be signed is a concatenated string of the form data (except the order data)
        $sign = $data['paymentAmount'] .
            $data['currencyCode'] .
            $data['shipBeforeDate'] .
            $data['merchantReference'] .
            $data['skinCode'] .
            $data['merchantAccount'] .
            $data['sessionValidity'] .
            $data['shopperEmail'] .
            $data['shopperReference'] .
            $data['recurringContract'] .
            $data['allowedMethods'] .
            $data['blockedMethods'];

        // base64 encoding is necessary because the string needs to be send over the internet and
        // the hexadecimal result of the HMAC encryption could include escape characters
        return base64_encode(hash_hmac('sha256', $sign, pack("H*", $this->getSecret()), true));
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
