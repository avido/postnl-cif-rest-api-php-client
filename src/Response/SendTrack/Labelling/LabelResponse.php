<?php
namespace Avido\PostNLCifClient\Response\SendTrack\Labelling;

/**
  @File: LabelResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Label response
  @Dependencies:
 */
use Avido\PostNLCifClient\Response\BaseResponse;
use Avido\PostNLCifClient\Entities\Shipment;

class LabelResponse extends BaseResponse
{
    protected $merged_labels = [];
    protected $shipments = [];

    /**
     *
     * @access public
     * @param array $shipments shipments(/labels) generated
     * @param array $merged_labels if multiple shipments are requested merged labels will contain label
     *                      information about the merged shipments
     */
    public function __construct(array $shipments = [], array $merged_labels = [])
    {
        parent::__construct();
        $this->setShipments($shipments)
            ->setMergedLabels($merged_labels);
    }

    public function addShipment($shipment): void
    {
        if (!$shipment instanceof Shipment) {
            $shipment = new Shipment($shipment);
        }
        $this->shipments[] = $shipment;
    }
    /**
     * Set merged labels
     *
     * @access public
     * @param array $labels
     * @return $this
     */
    public function setMergedLabels(array $labels = []): LabelResponse
    {
        $this->merged_labels = $labels;
        return $this;
    }

    /**
     * Get merged labels
     *
     * @access public
     * @return array
     */
    public function getMergedLabels(): array
    {
        return $this->merged_labels;
    }

    /**
     * Set Shipments
     *
     * @access public
     * @param array $shipments
     * @return $this
     */
    public function setShipments(array $shipments = []): LabelResponse
    {
        // update array to use shipment entity
        foreach ($shipments as $shipment) {
            $this->addShipment($shipment);
        }
        return $this;
    }

    /**
     * Get Shipments
     *
     * @access public
     * @return array
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }
}
