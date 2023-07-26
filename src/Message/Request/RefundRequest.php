<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\RefundResponse;

class RefundRequest extends AbstractAdyenRequest
{


    use PurchaseTrait;

    protected function getRequestMethod()
    {
        return self::POST;
    }

    protected function getEndpoint()
    {

        return '/payments/' . $this->getOriginalReference() . '/refunds';

    }

    protected function getResponseClass()
    {
        return RefundResponse::class;
    }


    public function getData()
    {
        $this->validate('apiKey', 'merchantAccount', 'apiBaseUrl', 'amount', 'currency', 'originalReference');

        $data = [
            'merchantAccount' => $this->getMerchantAccount(),
            'amount'          => [
                'value'    => $this->getAmountInteger(),
                'currency' => $this->getCurrency()
            ],
        ];

        return $data;
    }

    public function getOriginalReference()
    {
        return $this->getParameter('originalReference');
    }

    public function setOriginalReference($value)
    {
        return $this->setParameter('originalReference', $value);
    }

}
