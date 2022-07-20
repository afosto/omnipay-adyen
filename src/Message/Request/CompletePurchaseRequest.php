<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\CompletePurchaseResponse;

class CompletePurchaseRequest extends AbstractAdyenRequest
{
    public function setPaymentData($value)
    {
        $this->setParameter('paymentData', $value);
    }

    public function getPaymentData()
    {
        return $this->getParameter('paymentData');
    }

    public function setRedirectResult($value)
    {
        $this->setParameter('redirectResult', $value);
    }

    public function getRedirectResult()
    {
        return $this->getParameter('redirectResult');
    }

    public function set3dsResult($value)
    {
        $this->setParameter('3dsResult', $value);
    }

    public function get3dsResult()
    {
        return $this->getParameter('3dsResult');
    }

    protected function getRequestMethod()
    {
        return self::POST;
    }

    protected function getEndpoint()
    {
        return '/payments/details';
    }

    protected function getResponseClass()
    {
        return CompletePurchaseResponse::class;
    }

    public function getData()
    {

        $this->validate('apiKey', 'merchantAccount', 'apiBaseUrl', 'amount', 'currency', 'transactionId');

        $data = null;

        if ($this->getRedirectResult() !== null) {
            $data['details']['redirectResult'] = $this->getRedirectResult();
        } elseif ($this->get3dsResult() !== null) {
            $data['details']['threeDSResult'] = $this->get3dsResult();
        }

        return $data;
    }
}
