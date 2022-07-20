<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Message\RedirectResponseInterface;

class LinkResponse extends AbstractAdyenResponse implements RedirectResponseInterface
{

    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] == 'active';
    }

    public function getTransactionId()
    {
        return $this->data['id'];
    }

    public function getTransactionReference()
    {
        if (isset($this->data['reference'])) {
            return $this->data['reference'];
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
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {

        if ($this->isRedirect()) {
            return $this->data['url'];
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
