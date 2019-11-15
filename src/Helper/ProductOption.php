<?php
namespace Avido\PostNLCifClient\Helper;

/**
  @File: ProductOption.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        (Selected) Product Option for labeling
  @Dependencies:
*/

class ProductOption
{
    private $code;
    private $label;
    private $isExtraCover = false;
    private $isEvening = false;
    private $isSunday = false;
    private $isCod = false;
    private $statedAddressOnly = false;
    private $countryLimitation;
    private $group;

    public function __construct($data = [])
    {
        foreach ($data as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /**
     * Get Product Option Code
     *
     * @access public
     * @return string
     */
    public function getCode(): string
    {
        return $this->code ?? '';
    }
    /**
     * Get readable label for product option
     *
     * @access public
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label ?? '';
    }

    /**
     * Indicates extra cover is required for product option
     *
     * @access public
     * @return boolean
     */
    public function isExtraCover(): bool
    {
        return $this->isExtraCover;
    }
    /**
     * Indicates product code is evening delivery
     *
     * @access public
     * @return boolean
     */
    public function isEvening(): bool
    {
        return $this->isEvening;
    }
    /**
     * Indicates product code is sunday delivery
     *
     * @access public
     * @return boolean
     */
    public function isSunday(): bool
    {
        return $this->isSunday;
    }
    /**
     * Indicates product code is Cash On Delivery
     *
     * @access public
     * @return boolean
     */
    public function isCOD(): bool
    {
        return $this->isCod;
    }

    /**
     * Indicates product code is stated address only
     *
     * @access public
     * @return boolean
     */
    public function isStatedAddressOnly(): bool
    {
        return $this->statedAddressOnly;
    }
    /**
     * Check if product code can be used for (delivery) country
     *
     * @access public
     * @param string $country
     * @return boolean
     */
    public function matchCountry(string $country): bool
    {
        return (is_null($this->getCountries()) || in_array($country, $this->getCountries())) ? true : false;
    }

    /**
     * Get Possible country limitations for product code
     *
     * @access public
     * @return mixed null|array - null = no limitations
     */
    public function getCountries(): array
    {
        if ($this->countryLimitation === null || $this->countryLimitation === false) {
            return null;
        }
        if (!is_array($this->countryLimitation)) {
            return [$this->countryLimitation];
        } else {
            return $this->countryLimitation;
        }
    }
}
