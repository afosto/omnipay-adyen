<?php

namespace Omnipay\Adyen\Message\Response;

class FetchRedirectResultResponse extends AbstractAdyenResponse
{

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return isset($this->data['resultCode']) && $this->data['resultCode'] === "Cancelled";
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return isset($this->data['resultCode']) && $this->data['resultCode'] === "Pending";
    }


    /**
     * @return bool
     */
    public function isExpired()
    {
        return isset($this->data['resultCode']) && $this->data['resultCode'] === "Refused";
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
        return in_array($this->data['resultCode'], ['Received', 'Authorised']);
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return $this->data['resultCode'] == "Authorised";
    }


}