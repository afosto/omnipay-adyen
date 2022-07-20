<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\FetchRedirectResultResponse;

class FetchRedirectResultRequest extends AbstractAdyenRequest
{

    public function setRedirectResult($value)
    {
        $this->setParameter('redirectResult', $value);
    }

    public function getRedirectResult()
    {
        return $this->getParameter('redirectResult');
    }

    protected function getRequestMethod()
    {
        return static::POST;
    }

    protected function getEndpoint()
    {
        return '/payments/details';
    }

    protected function getResponseClass()
    {
        return FetchRedirectResultResponse::class;
    }

    public function getData()
    {

        $this->validate('redirectResult');
        return [
            'details' => [
                'redirectResult' => $this->getRedirectResult()
            ]];
    }
}