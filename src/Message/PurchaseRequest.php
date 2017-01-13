<?php

namespace Omnipay\Adyen\Message;

use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest {

    public function getData() {
        $this->validate('secret', 'amount', 'sessionLifetime', 'merchantAccount', 'skinCode', 'daysToShipping');
        $data = [];

        $data['paymentAmount'] = $this->getAmountInteger();
        $data['currencyCode'] = $this->getCurrency();
        $data['shipBeforeDate'] = $this->getShipBeforeDate();
        $data['merchantReference'] = $this->getTransactionId();
        $data['skinCode'] = $this->getSkinCode();
        $data['merchantAccount'] = $this->getMerchantAccount();
        $data['sessionValidity'] = $this->getSessionValidity();
        $data['shopperEmail'] = $this->getCard()->getEmail();
        $data['shopperReference'] = $this->getCard()->getEmail();
        $data['recurringContract'] = 'ONECLICK';
        $data['allowedMethods'] = '';
        $data['blockedMethods'] = '';
        $data['countryCode'] = $this->getCard()->getCountry();
        $data['resURL'] = $this->getReturnUrl();
        $data['merchantSig'] = $this->generateSignature($data);

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
