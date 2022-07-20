<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Message\AbstractResponse;

abstract class AbstractAdyenResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data != [] && $this->data != null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return json_encode($this->data);
    }
}
