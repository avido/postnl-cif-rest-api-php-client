<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: CustomsContent.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Customs/Content Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class CustomsContent extends BaseEntity
{
    /**
     * Description of goods
     * @var String
     */
    private $Description = null;
    /**
     * A unique code for a product. Together with HS number this is mandatory for
     * product code 4992(Direct Parcel to China).
     * @var String
     */
    private $EAN = null;
    /**
     * Webshop URL of the product which is being shipped. Mandatory for
     * product code 4992(Direct Parcel to China).
     * @var String
     */
    private $ProductURL = null;
    /**
     * Quantity of items in description
     * @var Int
     */
    protected $Quantity = null;
    /**
     * Net weight of goods in gram (gr)
     * @var Int
     */
    protected $Weight = null;
    /**
     * Commercial (customs) value of goods. (decimal separator, eg: 20.99)
     * @var String
     */
    protected $Value = null;
    /**
     * First 6 numbers of Harmonized System Code
     * @var String
     */
    protected $HSTariffNr = null;
    /**
     * Origin country code
     * @var String
     */
    protected $CountryOfOrigin = null;


    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * Set Description
     *
     * @access public
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): CustomsContent
    {
        $this->Description = $description;
        return $this;
    }

    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description ?? '';
    }

    /**
     * Set EAN
     *
     * @access public
     * @param string $ean
     * @return $this
     */
    public function setEAN(string $ean): CustomsContent
    {
        $this->EAN = $ean;
        return $this;
    }

    /**
     * Get EAN
     *
     * @access public
     * @return string
     */
    public function getEAN(): string
    {
        return $this->EAN ?? '';
    }


    /**
     * Set ProductURL
     *
     * @access public
     * @param string $url
     * @return $this
     */
    public function setProductURL(string $url): CustomsContent
    {
        $this->ProductURL = $url;
        return $this;
    }

    /**
     * Get ProductURL
     *
     * @access public
     * @return boolean
     */
    public function getProductURL(): string
    {
        return $this->ProductURL ?? '';
    }

    /**
     * Set Quantity
     *
     * @access public
     * @param int $quantity
     * @return $this
     */
    public function setQuantity(int $quantity): CustomsContent
    {
        $this->Quantity = $quantity;
        return $this;
    }

    /**
     * Get Quantity
     *
     * @access public
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->Quantity ?? 1;
    }

    /**
     * Set Weight
     *
     * @access public
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight): CustomsContent
    {
        $this->Weight = $weight;
        return $this;
    }

    /**
     * Get Weight
     *
     * @access public
     * @return int
     */
    public function getWeight(): int
    {
        return $this->Weight ?? 0;
    }

    /**
     * Set Value
     *
     * @access public
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): CustomsContent
    {
        $this->Value = $value;
        return $this;
    }

    /**
     * Get Value
     *
     * @access public
     * @return string
     */
    public function getValue(): string
    {
        return $this->Value ?? '';
    }

    /**
     * Set HSTariffNr
     *
     * @access public
     * @param string $tariff
     * @return $this
     */
    public function setHSTariffNr(string $tariff): CustomsContent
    {
        $this->HSTariffNr = $tariff;
        return $this;
    }

    /**
     * Get HSTariffNr
     *
     * @access public
     * @return string
     */
    public function getHSTariffNr(): string
    {
        return $this->HSTariffNr ?? '';
    }

    /**
     * Set CountryOfOrigin
     *
     * @access public
     * @param string $country
     * @return $this
     */
    public function setCountryOfOrigin(string $country): CustomsContent
    {
        $this->CountryOfOrigin = $country;
        return $this;
    }

    /**
     * Get CountryOfOrigin
     *
     * @access public
     * @return string
     */
    public function getCountryOfOrigin(): string
    {
        return $this->CountryOfOrigin ?? '';
    }
}
