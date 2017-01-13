<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse {

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful() {
        if (!array_key_exists('merchantSig', $this->getData()) || $this->getData()['merchantSig'] != $this->request->calculateSignature()) {
            return false;
        }

        return array_key_exists('authResult', $this->getData()) && $this->getData()['authResult'] == 'AUTHORISED';
    }

    /**
     * The Adyen pspReference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference() {
        if (array_key_exists('pspReference', $this->getData())) {
            return $this->getData()['pspReference'];
        } else {
            return null;
        }
    }
}