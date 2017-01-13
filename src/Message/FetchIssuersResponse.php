<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Issuer;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\FetchIssuersResponseInterface;

class FetchIssuersResponse extends AbstractResponse implements FetchIssuersResponseInterface {

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful() {
        return true;
    }

    /**
     * Get the returned list of issuers.
     *
     * These represent banks which the user must choose between.
     *
     * @return \Omnipay\Common\Issuer[]
     */
    public function getIssuers() {
        $issuers = [];

        foreach ($this->getData()['paymentMethods'] as $method) {
            if (!empty($method['issuers'])) {
                foreach ($method['issuers'] as $issuer) {
                    $issuers[] = new Issuer($issuer['issuerId'], $issuer['name'], $method['brandCode']);
                }
            }
        }

        return $issuers;
    }
}