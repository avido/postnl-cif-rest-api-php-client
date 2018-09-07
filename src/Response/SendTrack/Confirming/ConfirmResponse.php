<?php
namespace Avido\PostNLCifClient\Response\SendTrack\Confirming;

/**
  @File: ConfirmResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Confirm response
  @Dependencies:
 */
use Avido\PostNLCifClient\Response\BaseResponse;
use Avido\PostNLCifClient\Entities\Warning;
use Avido\PostNLCifClient\Entities\Error;

class ConfirmResponse extends BaseResponse
{
    /**
     * Barcode
     * @var String
     */
    protected $Barcode = null;
    
    /**
     *
     * @access public
     * @param array $confirmResponse confirmation response
     */
    public function __construct($data=[])
    {
        parent::__construct();
        $this->initFromArray($data);
    }
    
    /**
     * Set barcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setBarcode($barcode = null)
    {
        $this->Barcode = (string)$barcode;
        return $this;
    }
    
    /**
     * Get Barcode
     *
     * @access public
     * @return string
     */
    public function getBarcode()
    {
        return (string)$this->Barcode;
    }
}
