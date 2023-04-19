<?php

namespace Omnipay\Adyen\Message\Request;

use Omnipay\Adyen\Message\Response\LinkResponse;
use Omnipay\Adyen\Message\Response\PurchaseResponse;
use Omnipay\Common\Item;

class LinkRequest extends AbstractAdyenRequest
{


    use PurchaseTrait;

    protected function getRequestMethod()
    {
        return self::POST;
    }

    protected function getEndpoint()
    {

        return '/paymentLinks';

    }

    protected function getResponseClass()
    {
        return LinkResponse::class;
    }


    public function getData()
    {
        $this->validate('apiKey', 'merchantAccount', 'apiBaseUrl', 'amount', 'currency', 'transactionId');

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
        $data = [
            'merchantAccount'       => $this->getMerchantAccount(),
            'returnUrl'             => $this->getReturnUrl(),
            'countryCode'           => $this->getCountry(),
            'amount'                => [
                'value'    => $this->getAmountInteger(),
                'currency' => $this->getCurrency()
            ],
            'lineItems'             => $items,
            'shopperLocale'         => $this->getLocale(),
            'reference'             => $this->getDescription(),
            'allowedPaymentMethods' => [$this->getPaymentMethod()],
            'shopperReference'      => $this->getDescription(),
            'shopperIP'             => $this->getClientIp(),

        ];

        if ($this->getCard() != null) {
            $rootAddress = [
                'city'              => $this->getCard()->getCity(),
                'country'           => $this->getCard()->getCountry(),
                'houseNumberOrName' => '',
                'street'            => $this->getCard()->getAddress1(),
                'postalCode'        => $this->getCard()->getPostcode(),
                'stateOrProvince'   => $this->getCard()->getState(),
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

            $data['countryCode'] = $billingAddress['country'];

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

        return $data;
    }
}
