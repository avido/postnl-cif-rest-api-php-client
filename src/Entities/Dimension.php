<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Dimension.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Shipment Dimension Entity
  @Dependencies:
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;

class Dimension extends BaseModel
{
    private $Height = null;
    private $Length = null;
    private $Volume = null;
    private $Weight = null;
    private $Width = null;
    
    public function __construct($weight=0, $height=null, $length=null, $width=null, $volume=null)
    {
        parent::__construct();
        $this->setWeight($weight)
            ->setHeight($height)
            ->setLength($length)
            ->setWidth($width)
            ->setVolume($volume);
    }
    
    /**
     * Set Height in milimeters (mm)
     *
     * @access public
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->Height = (int)$height;
        return $this;
    }
    
    /**
     * Set Length in milimeters (mm)
     *
     * @access public
     * @param int $length
     * @return $this
     */
    public function setLength($length)
    {
        $this->Length = (int)$length;
        return $this;
    }
    
    /**
     * Set Volume in cm (cm3), mandatory for E@H-products
     *
     * @access public
     * @param int $volume
     * @return $this
     */
    public function setVolume($volume)
    {
        $this->Volume = (int)$volume;
        return $this;
    }
    
    /**
     * Set Weight in grams
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
     * Set Width in milimeters (mm)
     *
     * @access public
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->Width= (int)$width;
        return $this;
    }
    
    /**
     * Get Height in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getHeight()
    {
        return (int)$this->Height;
    }
    
    /**
     * Get Length in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getLength()
    {
        return (int)$this->Length;
    }
    
    /**
     * Get Volume in cm (cm3), mandatory for E@H-products
     *
     * @access public
     * @return int
     */
    public function getVolume()
    {
        return (int)$this->Volume;
    }
    
    /**
     * Get Weight in grams
     *
     * @access public
     * @return int
     */
    public function getWeight()
    {
        return (int)$this->Weight;
    }
    
    /**
     * Get Width in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getWidth()
    {
        return (int)$this->Width;
    }
}
