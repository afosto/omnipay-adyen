<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchIssuersResponse;

class FetchIssuersRequest extends AbstractAdyenRequest
{

    use ContextTrait;

    public function getData()
    {
        $this->validate('apiKey');

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

    protected function getResponseClass()
    {
        return FetchIssuersResponse::class;
    }
}
