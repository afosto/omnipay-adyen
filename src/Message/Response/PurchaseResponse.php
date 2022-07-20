<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractAdyenResponse implements RedirectResponseInterface
{

    public function isSuccessful()
    {
        if (isset($this->data['resultCode'])) {
            switch ($this->data['resultCode']) {
                case 'Authorised':
                    return true;
                case 'AuthenticationFinished':
                case 'AuthenticationNotRequired':
                case 'Cancelled':
                case 'ChallengeShopper':
                case 'Error':
                case 'IdentifyShopper':
                case 'Pending':
                case 'PresentToShopper':
                case 'Received':
                case 'RedirectShopper':
                case 'Refused':
                    return false;
            }
        }

        return false;
    }

    public function getTransactionId()
    {
        return $this->data['merchantReference'];
    }

    public function getTransactionReference()
    {
        if (isset($this->data['pspReference'])) {
            return $this->data['pspReference'];
        }
        return parent::getTransactionReference();
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return isset($this->data['action']) &&
            isset($this->data['action']['type']) &&
            $this->data['action']['type'] == 'redirect';
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {

        if ($this->isRedirect()) {
            return $this->data['action']['url'];
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return null;
    }
}
