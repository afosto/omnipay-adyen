<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchPaymentMethodsResponse;
use Omnipay\Common\Exception\InvalidRequestException;

class FetchPaymentMethodsRequest extends AbstractAdyenRequest
{

    use PurchaseTrait;

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('apiKey', 'merchantAccount', 'apiBaseUrl');

        $amount = null;
        if ($this->getAmountInteger() || $this->getCurrency()) {
            $this->validate('amount', 'currency');

            $amount = [
                'value'    => $this->getAmountInteger(),
                'currency' => $this->getCurrency(),
            ];
        }

        return [
            'merchantAccount' => $this->getMerchantAccount(),
            'countryCode'     => $this->getCountry(),
            'amount'          => $amount,
            'channel'         => $this->getChannel(),
            'shopperLocale'   => $this->getLocale(),
        ];
    }


    protected function getRequestMethod()
    {
        return self::POST;
    }

    protected function getEndpoint()
    {
        return '/paymentMethods';
    }

    /**
     * @return string
     */
    protected function getResponseClass()
    {
        return FetchPaymentMethodsResponse::class;
    }
}
