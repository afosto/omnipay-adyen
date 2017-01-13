<?php

namespace Omnipay\Adyen\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest {

    protected $liveEndpoint = 'https://live.adyen.com/hpp/';
    protected $testEndpoint = 'https://test.adyen.com/hpp/';

    /**
     * @return string|null
     */
    public function getSecret() {
        return $this->getParameter('secret');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSecret($value) {
        return $this->setParameter('secret', $value);
    }

    /**
     * @return string|null
     */
    public function getSkinCode() {
        return $this->getParameter('skinCode');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSkinCode($value) {
        return $this->setParameter('skinCode', $value);
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
     * @return \Omnipay\Common\Message\AbstractRequest
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

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantAccount($value) {
        return $this->setParameter('merchantAccount', $value);
    }

    /**
     * @return string|null
     */
    public function getDaysToShipping() {
        return $this->getParameter('daysToShipping');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setDaysToShipping($value) {
        return $this->setParameter('daysToShipping', $value);
    }

    /**
     * Generate a signature for a data set
     *
     * @param array$data
     *
     * @return string
     *
     * @see https://docs.adyen.com/developers/hpp-manual#hpphmaccalculation
     */
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

    /**
     * @return string
     */
    public function getShipBeforeDate() {
        return date('c', strtotime('+' . $this->getDaysToShipping() . ' days'));
    }

    /**
     * @return string
     */
    public function getSessionValidity() {
        return date('c', time() + ($this->getSessionLifetime() * 60));
    }

    /**
     * @return string
     */
    public function getEndpoint() {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
