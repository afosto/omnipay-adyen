<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchLinkResponse;

class FetchLinkRequest extends AbstractAdyenRequest
{

    protected function getRequestMethod()
    {
        return static::GET;
    }

    protected function getEndpoint()
    {
        return '/paymentLinks/' . $this->getTransactionReference();
    }

    protected function getResponseClass()
    {
        return FetchLinkResponse::class;
    }

    public function getData()
    {
        return [];
    }
}