<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchIssuersResponse;

class FetchIssuersRequest extends FetchPaymentMethodsRequest
{

    use PurchaseTrait;

    protected function getResponseClass()
    {
        return FetchIssuersResponse::class;
    }
}
