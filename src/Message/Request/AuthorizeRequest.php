<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\AuthorizeResponse;
use Omnipay\Common\Item;

class AuthorizeRequest extends AbstractAdyenRequest
{

    use ContextTrait;

    protected function getRequestMethod()
    {
        return self::POST;
    }

    protected function getEndpoint()
    {
        return '/payments';
    }

    protected function getResponseClass()
    {
        return AuthorizeResponse::class;
    }

    public function getData()
    {
        $this->validate('apiKey', 'amount', 'currency', 'transactionId');

        $items = [];
        if ($this->getItems() != null) {
            foreach ($this->getItems() as $item) {
                /**
                 * @var $item Item
                 */
                $items[] = [
                    'id'                 => $item->getName(),
                    'description'        => $item->getDescription(),
                    'quantity'           => $item->getQuantity(),
                    'amountIncludingTax' => $item->getPrice(),
                ];
            }
        }

        $paymentMethod = [
            'type' => $this->getPaymentMethod()
        ];

        if ($this->getIssuer() != "") {
            $paymentMethod['issuer'] = $this->getIssuer();
        }

        $data = [
            'merchantAccount' => $this->getMerchantAccount(),
            'returnUrl'       => $this->getReturnUrl(),
            'countryCode'     => $this->getCountry(),
            'amount'          => [
                'value'    => $this->getAmountInteger(),
                'currency' => $this->getCurrency()
            ],
            'lineItems'       => $items,
            'channel'         => $this->getChannel(),
            'shopperLocale'   => $this->getLocale(),
            'paymentMethod'   => $paymentMethod,
            'reference'       => $this->getTransactionId(),
            'shopperIP'       => $this->getClientIp(),
        ];

        if ($this->getCard() != null) {
            $rootAddress = [
                'city'            => $this->getCard()->getCity(),
                'country'         => $this->getCard()->getCountry(),
                'street'          => $this->getCard()->getAddress1(),
                'postalCode'      => $this->getCard()->getPostcode(),
                'stateOrProvince' => $this->getCard()->getState(),
            ];


            $billingAddress = [
                'city'            => $this->getCard()->getBillingCity(),
                'country'         => $this->getCard()->getBillingCountry(),
                'street'          => $this->getCard()->getBillingAddress1(),
                'postalCode'      => $this->getCard()->getBillingPostcode(),
                'stateOrProvince' => $this->getCard()->getBillingState(),
            ];
            array_filter($billingAddress);
            $billingAddress = array_merge($rootAddress, $billingAddress);


            $shippingAddress = [
                'city'            => $this->getCard()->getShippingCity(),
                'country'         => $this->getCard()->getShippingCountry(),
                'street'          => $this->getCard()->getShippingAddress1(),
                'postalCode'      => $this->getCard()->getShippingPostcode(),
                'stateOrProvince' => $this->getCard()->getShippingState(),
            ];
            array_filter($shippingAddress);
            $shippingAddress = array_merge($rootAddress, $shippingAddress);

            $data['billingAddress'] = $billingAddress;
            $data['deliveryAddress'] = $shippingAddress;
            $data['company']['name'] = $this->getCard()->getBillingCompany();
            $data['shopperEmail'] = $this->getCard()->getEmail();
            $data['shopperName'] = $this->getCard()->getName();
            $data['telephoneNumber'] = $this->getCard()->getPhone();
        }

        echo json_encode($data);
        exit();

        return $data;
    }
}
