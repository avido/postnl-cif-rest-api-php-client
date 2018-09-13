<?php
namespace Avido\PostNLCifClient\Request\SendTrack\ShippingStatus;

/**
    @File: StatusRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/send-and-track/shippingstatus-webservice/documentation/
    @copyright   Avido

    Shipping Status Request Object
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class StatusRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'status';
    private $version = '1_6';

    /**
     * Shipment Barcode
     * @var string
     */
    private $barcode = null;
    /**
     * Shipment reference
     * @var string
     */
    private $reference = null;
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
    }
    
    /**
     * Set Shipment barcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setBarcode($barcode)
    {
        $this->barcode = (string)$barcode;
        return $this;
    }
    /**
     * Get Shipment barcode
     *
     * @access public
     * @return string
     */
    public function getBarcode()
    {
        return (string)$this->barcode;
    }
}
