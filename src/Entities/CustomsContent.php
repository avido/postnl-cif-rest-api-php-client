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
    public function setDescription($description)
    {
        $this->Description = (string)$description;
        return $this;
    }
    
    /**
     * Get Description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return (string)$this->Description;
    }
    
    /**
     * Set EAN
     *
     * @access public
     * @param string $ean
     * @return $this
     */
    public function setEAN($ean)
    {
        $this->EAN = (string)$ean;
        return $this;
    }
    
    /**
     * Get EAN
     *
     * @access public
     * @return string
     */
    public function getEAN()
    {
        return (string)$this->EAN;
    }
    
    
    /**
     * Set ProductURL
     *
     * @access public
     * @param string $url
     * @return $this
     */
    public function setProductURL($url)
    {
        $this->ProductURL = (string)$url;
        return $this;
    }
    
    /**
     * Get ProductURL
     *
     * @access public
     * @return boolean
     */
    public function getProductURL()
    {
        return (string)$this->ProductURL;
    }
    
    /**
     * Set Quantity
     *
     * @access public
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->Quantity = (int)$quantity;
        return $this;
    }
    
    /**
     * Get Quantity
     *
     * @access public
     * @return int
     */
    public function getQuantity()
    {
        return (int)$this->Quantity;
    }
    
    /**
     * Set Weight
     *
     * @access public
     * @param int $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->Weight = (int)$weight;
        return $this;
    }
    
    /**
     * Get Weight
     *
     * @access public
     * @return int
     */
    public function getWeight()
    {
        return (int)$this->Weight;
    }
    
    /**
     * Set Value
     *
     * @access public
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->Value = (string)$value;
        return $this;
    }
    
    /**
     * Get Value
     *
     * @access public
     * @return string
     */
    public function getValue()
    {
        return (string)$this->Value;
    }
    
    /**
     * Set HSTariffNr
     *
     * @access public
     * @param string $tariff
     * @return $this
     */
    public function setHSTariffNr($tariff)
    {
        $this->HSTariffNr = (string)$tariff;
        return $this;
    }
    
    /**
     * Get HSTariffNr
     *
     * @access public
     * @return string
     */
    public function getHSTariffNr()
    {
        return (string)$this->HSTariffNr;
    }
    
    /**
     * Set CountryOfOrigin
     *
     * @access public
     * @param string $country
     * @return $this
     */
    public function setCountryOfOrigin($country)
    {
        $this->CountryOfOrigin = (string)$country;
        return $this;
    }
    
    /**
     * Get CountryOfOrigin
     *
     * @access public
     * @return string
     */
    public function getCountryOfOrigin()
    {
        return (string)$this->CountryOfOrigin;
    }
}
