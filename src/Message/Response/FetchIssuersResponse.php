<?php

namespace Omnipay\Adyen\Message\Response;

use Omnipay\Common\Issuer;
use Omnipay\Common\Message\FetchIssuersResponseInterface;

class FetchIssuersResponse extends AbstractAdyenResponse implements FetchIssuersResponseInterface
{

    public function getIssuers()
    {
        if (isset($this->data['paymentMethods']) === false) {
            return [];
        }

        $issuers = [];
        foreach ($this->data['paymentMethods'] as $methodData) {
            if (isset($methodData['issuers'])) {
                foreach ($methodData['issuers'] as $issuerData) {
                    $issuers[] = new Issuer($issuerData['id'], $issuerData['name'], $methodData['type']);
                }
            }
        }

        return $issuers;
    }
}
