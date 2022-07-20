<?php

namespace Omnipay\Adyen;

use Omnipay\Adyen\Message\Request\AuthTrait;
use Omnipay\Adyen\Message\Request\CompletePurchaseRequest;
use Omnipay\Adyen\Message\Request\FetchLinkRequest;
use Omnipay\Adyen\Message\Request\LinkRequest;
use Omnipay\Adyen\Message\Request\PurchaseTrait;
use Omnipay\Adyen\Message\Request\FetchIssuersRequest;
use Omnipay\Adyen\Message\Request\FetchPaymentMethodsRequest;
use Omnipay\Adyen\Message\Request\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\GatewayInterface;

class Gateway extends AbstractGateway implements GatewayInterface
{

    use PurchaseTrait, AuthTrait;

    public function getName()
    {
        return 'Adyen';
    }

    public function getDefaultParameters()
    {
        return [
            'apiKey'          => null,
            'merchantAccount' => null,
            'apiBaseUrl'      => null,
            'channel'         => 'web',
            'version'         => 'v69',
            'shopperLocale'   => null,
            'countryCode'     => null,
        ];
    }

    public function fetchPaymentMethods(array $parameters = [])
    {
        /** @var FetchPaymentMethodsRequest $request */
        $request = $this->createRequest(FetchPaymentMethodsRequest::class, $parameters);

        return $request;
    }

    public function fetchIssuers(array $parameters = [])
    {
        /** @var FetchIssuersRequest $request */
        $request = $this->createRequest(FetchIssuersRequest::class, $parameters);

        return $request;
    }


    public function fetchLink(array $parameters = []): FetchLinkRequest
    {
        /** @var FetchLinkRequest $request */
        $request = $this->createRequest(FetchLinkRequest::class, $parameters);

        return $request;
    }

    /**
     * @param array $parameters
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        /** @var PurchaseRequest $request */
        $request = $this->createRequest(PurchaseRequest::class, $parameters);

        return $request;
    }


    /**
     * @param array $parameters
     * @return LinkRequest
     */
    public function link(array $parameters = [])
    {
        /** @var LinkRequest $request */
        $request = $this->createRequest(LinkRequest::class, $parameters);

        return $request;
    }


    /**
     * @param array $parameters
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        /** @var CompletePurchaseRequest $request */
        $request = $this->createRequest(CompletePurchaseRequest::class, $parameters);

        return $request;
    }
}
