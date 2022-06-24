<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;

class FetchPaymentMethodsResponse extends AbstractAdyenResponse implements FetchPaymentMethodsResponseInterface
{

    public function getPaymentMethods()
    {

        if (isset($this->data['paymentMethods']) === false) {
            return [];
        }

        $paymentMethods = [];
        foreach ($this->data['paymentMethods'] as $method) {
            $paymentMethods[] = new PaymentMethod($method['type'], $method['name']);
        }

        return $paymentMethods;
    }
}
