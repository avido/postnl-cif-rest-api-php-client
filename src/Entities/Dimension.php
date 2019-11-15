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
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Dimension extends BaseEntity
{
    private $Height ;
    private $Length;
    private $Volume;
    private $Weight;
    private $Width;

    public function __construct($weight = 0, $height = null, $length = null, $width = null, $volume = null)
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
    public function setHeight(int $height): Dimension
    {
        $this->Height = $height;
        return $this;
    }

    /**
     * Get Height in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getHeight(): int
    {
        return $this->Height ?? 0;
    }


    /**
     * Set Length in milimeters (mm)
     *
     * @access public
     * @param int $length
     * @return $this
     */
    public function setLength(int $length): Dimension
    {
        $this->Length = $length;
        return $this;
    }

    /**
     * Get Length in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getLength(): int
    {
        return $this->Length ?? 0;
    }

    /**
     * Set Volume in cm (cm3), mandatory for E@H-products
     *
     * @access public
     * @param int $volume
     * @return $this
     */
    public function setVolume(int $volume): Dimension
    {
        $this->Volume = $volume;
        return $this;
    }

    /**
     * Get Volume in cm (cm3), mandatory for E@H-products
     *
     * @access public
     * @return int
     */
    public function getVolume(): int
    {
        return $this->Volume ?? 0;
    }

    /**
     * Set Weight in grams
     *
     * @access public
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight): Dimension
    {
        $this->Weight = $weight;
        return $this;
    }

    /**
     * Get Weight in grams
     *
     * @access public
     * @return int
     */
    public function getWeight(): int
    {
        return $this->Weight ?? 0;
    }

    /**
     * Set Width in milimeters (mm)
     *
     * @access public
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): Dimensio
    {
        $this->Width= $width;
        return $this;
    }

    /**
     * Get Width in milimeters (mm)
     *
     * @access public
     * @return int
     */
    public function getWidth(): int
    {
        return $this->Width ?? 0;
    }

    /**
     * Output dimensions entity as array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
    {
        return [
            'Height' => $this->getHeight(),
            'Length' => $this->getLength(),
            'Volume' => $this->getVolume(),
            'Weight' => $this->getWeight(),
            'Width' => $this->getWidth()
        ];
    }
}
