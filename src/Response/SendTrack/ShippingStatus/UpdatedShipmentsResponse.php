<?php
namespace Avido\PostNLCifClient\Response\SendTrack\ShippingStatus;

/**
  @File: UpdatedShipmentsResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Updated Shipments response
  @Dependencies:
 */
use Avido\PostNLCifClient\Response\BaseResponse;

use Avido\PostNLCifClient\Entities\Shipment;
use Avido\PostNLCifClient\Entities\Signature;

class UpdatedShipmentsResponse extends BaseResponse
{
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
        if (count($data) > 0) {
            $this->setShipments($data);
        }
    }

    /**
     * Set Shipments
     *
     * @access public
     * @param array $shipments
     * @return $this
     */
    public function setShipments(array $shipments): UpdatedShipmentsResponse
    {
        foreach ($shipments as $shipment) {
            $this->addShipment($shipment);
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
    public function addShipment($shipment): UpdatedShipmentsResponse
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
