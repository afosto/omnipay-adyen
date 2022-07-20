<?php

namespace Omnipay\Adyen\Message\Request;

trait AuthTrait
{

    abstract protected function getParameter($key);

    abstract protected function setParameter($key, $value);

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->getParameter('country_code');
    }

    public function setApiKey($value)
    {
        $this->setParameter('apiKey', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setVersion($value)
    {
        $this->setParameter('version', $value);
    }

    public function getVersion()
    {
        return $this->getParameter('version');
    }


    public function setMerchantAccount($value)
    {
        $this->setParameter('merchantAccount', $value);
    }

    public function getMerchantAccount()
    {
        return $this->getParameter('merchantAccount');
    }


    public function setApiBaseUrl($value)
    {
        $this->setParameter('apiBaseUrl', $value);
    }

    public function getApiBaseUrl()
    {
        return $this->getParameter('apiBaseUrl');
    }
}
