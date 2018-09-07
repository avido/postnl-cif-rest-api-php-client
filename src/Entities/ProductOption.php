<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: ProductOption.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Product Option Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class ProductOption extends BaseEntity
{
    /**
     * The characteristic of the ProductOption. Mandatory for some products, please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @var Int
     */
    protected $Characteristic = null;
    /**
     * The product option code for this ProductOption. Mandatory for some products, 
     * please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @var Int
     */
    protected $Option = null;
    
    public function __construct($data=[])
    {
        parent::__construct($data);
    }
    
    /**
     * Set Characteristic
     *
     * @access public
     * @param int $characteristic
     * @return $this
     */
    public function setCharacteristic($characteristic)
    {
        $this->Characteristic = (int)$characteristic;
        return $this;
    }
    
    /**
     * Get Characteristic
     *
     * @access public
     * @return int
     */
    public function getCharacteristic()
    {
        return (int)$this->Characteristic;
    }
    
    /**
     * Set Option
     *
     * @access public
     * @param int $option
     * @return $this
     */
    public function setOption($option)
    {
        $this->Option = (int)$option;
        return $this;
    }
    
    /**
     * Get Option
     *
     * @access public
     * @return int
     */
    public function getOption()
    {
        return (int)$this->Option;
    }
}
