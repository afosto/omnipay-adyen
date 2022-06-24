<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchIssuersResponse;

class FetchIssuersRequest extends FetchPaymentMethodsRequest
{

    use ContextTrait;

    protected function getResponseClass()
    {
        return FetchIssuersResponse::class;
    }
}
