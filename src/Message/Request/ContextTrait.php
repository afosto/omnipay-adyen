<?php

namespace Omnipay\Adyen\Message\Request;

trait ContextTrait
{

    abstract protected function getParameter($key);

    abstract protected function setParameter($key, $value);

    public function setChannel($value)
    {
        $this->setParameter('channel', $value);
    }

    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    public function setShopperReference($shopperReference)
    {
        $this->setParameter('shopperReference', $shopperReference);
    }

    public function getShopperReference()
    {
        return $this->getParameter('shopperReference');
    }

    public function setBrowserInfo($browserInfo)
    {
        $this->setParameter('browserInfo', $browserInfo);
    }

    public function getBrowserInfo()
    {
        return $this->getParameter('browserInfo');
    }

    public function setOrigin($origin)
    {
        $this->setParameter('origin', $origin);
    }

    public function getOrigin()
    {
        return $this->getParameter('origin');
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        return $this->setParameter('locale', $locale);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setCountry($code)
    {
        return $this->setParameter('country_code', $code);
    }
}
