<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;

class FetchPaymentMethodsResponse extends AbstractResponse implements FetchPaymentMethodsResponseInterface {

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful() {
        return true;
    }

    /**
     * Get the returned list of payment methods.
     *
     * These represent separate payment methods which the user must choose between.
     *
     * @return \Omnipay\Common\PaymentMethod[]
     */
    public function getPaymentMethods() {
        return array_map(function ($method) {
            return new PaymentMethod($method['brandCode'], $method['name']);
        }, $this->getData()['paymentMethods']);
    }
}