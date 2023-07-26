<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class RefundResponse extends AbstractAdyenResponse implements ResponseInterface
{

    public function isSuccessful()
    {
        if (isset($this->data['status']) && $this->data['status'] == 'received') {
            return true;
        }

        return false;
    }

    public function getTransactionReference()
    {
        if (isset($this->data['pspReference'])) {
            return $this->data['pspReference'];
        }
        return parent::getTransactionReference();
    }
}
