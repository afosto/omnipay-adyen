<?php

namespace Omnipay\Adyen\Message\Response;

class FetchLinkResponse extends AbstractAdyenResponse
{

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return isset($this->data['status']) && $this->data['status'] === "expired";
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return isset($this->data['status']) && $this->data['status'] === "paymentPending";
    }


    /**
     * @return bool
     */
    public function isExpired()
    {
        return isset($this->data['status']) && $this->data['status'] === "expired";
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->data['id'];
    }


    /**
     * @return float|null
     */
    public function getAmount()
    {
        return $this->data['amount']['value'] / 100;
    }

    /**
     * @return string|null The paid currency
     */
    public function getCurrency()
    {
        return $this->data['amount']['currency'];
    }

    /**
     * @return boolean
     */
    public function isPaid()
    {
        return $this->data['status'] == 'completed';
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return $this->data['status'] == 'completed';
    }



}