<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest {

    public function getData() {
        $this->validate('secret', 'amount', 'secret', 'sessionLifetime', 'merchantAccount', 'skinCode', 'daysToShipping');
        $data = [];

        // Compulsory fields (needed to compute the signature)
        $data['paymentAmount'] = $this->getAmountInteger();
        $data['currencyCode'] = $this->getCurrency();
        $data['shipBeforeDate'] = $this->getShipBeforeDate();
        $data['merchantReference'] = $this->getTransactionReference();
        $data['skinCode'] = $this->getSkinCode();
        $data['merchantAccount'] = $this->getMerchantAccount();
        $data['sessionValidity'] = $this->getSessionValidity();
        $data['shopperEmail'] = $this->getCard()->getEmail();
        $data['shopperReference'] = $this->getCard()->getEmail();
        $data['recurringContract'] = 'ONECLICK';
        $data['allowedMethods'] = '';
        $data['blockedMethods'] = '';
        $data['merchantSig'] = $this->generateSignature($data);

        // Optional fields (Not needed in signature)
        $data['countryCode'] = $this->getCard()->getCountry();
        $data['resURL'] = $this->getReturnUrl();

        return $data;
    }

    /**
     * Send the request with specified data.
     * Adyen is a Off-site gateway - No need to send request, instead we need to redirect customer to Adyen site
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data) {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
