<?php
namespace Avido\PostNLCifClient\Response\SendTrack\ShippingStatus;

/**
  @File: StatusResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Status response
  @Dependencies:
 */
use Avido\PostNLCifClient\Response\BaseResponse;

use Avido\PostNLCifClient\Entities\Shipment;
use Avido\PostNLCifClient\Entities\Signature;

class StatusResponse extends BaseResponse
{
    /**
     * Barcode
     * @var String
     */
    protected $Barcode = null;

    /**
     * Signature
     * @var Entities/Signature
     */
    protected $Signature = null;

    /**
     * Shipment with status information
     * @var array Entities/shipment
     */
    private $Shipments = [];


    /**
     *
     * @access public
     * @param array $data Shipment Status response Post NL
     */

    public function __construct($data = [])
    {
        parent::__construct();
        if (isset($data['Signature'])) {
            $this->setSignature($data['Signature']);
        }
        if (isset($data['CurrentStatus']) && isset($data['CurrentStatus']['Shipment'])) {
            $this->setShipments($data['CurrentStatus']['Shipment']);
        }
        if (isset($data['CompleteStatus']) && isset($data['CompleteStatus']['Shipment'])) {
            $this->setShipments($data['CompleteStatus']['Shipment']);
        }
    }

    /**
     * Set Signature
     *
     * @access public
     * @param Array $signature
     * @return $this
     */
    public function setSignature($signature): StatusResponse
    {
        if (!$signature instanceof Signature) {
            $this->Signature = new Signature($signature);
        }
        return $this;
    }

    /**
     * Get Signature
     *
     * @access public
     * @return Entities/Signature
     */
    public function getSignature(): Signature
    {
        return $this->Signature;
    }

    /**
     * Set Shipments
     *
     * @access public
     * @param array $shipments
     * @return $this
     */
    public function setShipments(array $shipments): StatusResponse
    {
        if (is_array($shipments)) {
            // check for multiple shipments
            if (isset($shipments[0])) {
                foreach ($shipments as $shipment) {
                    $this->addShipment($shipment);
                }
            } else {
                $this->addShipment($shipments);
            }
        }
        return $this;
    }
    /**
     * Add Shipment
     *
     * @access public
     * @param Array $shipment
     * @return $this
     */
    public function addShipment($shipment): StatusResponse
    {
        if (!$shipment instanceof Shipment) {
            $shipment = new Shipment($shipment);
        }
        $this->Shipments[] = $shipment;
        return $this;
    }

    /**
     * Get Shipments
     *
     * @access public
     * @return array Entities/Shipment
     */
    public function getShipments(): array
    {
        return $this->Shipments;
    }
}
