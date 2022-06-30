<?php

namespace Omnipay\Adyen;

use Omnipay\Adyen\Message\Request\ApiTrait;
use Omnipay\Adyen\Message\Request\CompleteAuthorizeRequest;
use Omnipay\Adyen\Message\Request\ContextTrait;
use Omnipay\Adyen\Message\Request\FetchIssuersRequest;
use Omnipay\Adyen\Message\Request\FetchPaymentMethodsRequest;
use Omnipay\Adyen\Message\Request\AuthorizeRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\GatewayInterface;

class Gateway extends AbstractGateway implements GatewayInterface
{

    use ContextTrait, ApiTrait;

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

    /**
     * @param array $parameters
     * @return AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        /** @var AuthorizeRequest $request */
        $request = $this->createRequest(AuthorizeRequest::class, $parameters);

        return $request;
    }


    /**
     * @param array $parameters
     * @return CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = [])
    {
        /** @var CompleteAuthorizeRequest $request */
        $request = $this->createRequest(CompleteAuthorizeRequest::class, $parameters);

        return $request;
    }
}
