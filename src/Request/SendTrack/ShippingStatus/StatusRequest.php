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
use Avido\PostNLCifClient\Util\Date;

class StatusRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'status';
    private $version = '2';

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

    /**
     * @var array $periods - Filter updatedStatusses on period.
     */
    private $periods = [];

    public function __construct(
        ?string $barcode = null,
        ?string $reference = null,
        ?array $periods = []
    ) {
        parent::__construct($this->endpoint, $this->path, $this->version);
        if (!is_null($barcode)) {
            $this->setBarcode($barcode);
        }
        if (!is_null($reference)) {
            $this->setReference($reference);
        }
        if (count($periods) > 0) {
            foreach ($periods as $period) {
                if (!$period instanceof Date) {
                    $period = new Date($period);
                }
                $this->addPeriod($period);
            }
        }
    }

    /**
     * Set Shipment barcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setBarcode(string $barcode): StatusRequest
    {
        $this->barcode = $barcode;
        return $this;
    }
    /**
     * Get Shipment barcode
     *
     * @access public
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }
    /**
     * Set Shipment Reference
     *
     * @access public
     * @param string $reference
     * @return \Avido\PostNLCifClient\Request\SendTrack\ShippingStatus\StatusRequest
     */
    public function setReference(string $reference): StatusRequest
    {
        $this->reference = $reference;
        return $this;
    }
    /**
     * Get Shipment Reference
     *
     * @access public
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Add Filter date period
     *
     * @access public
     * @param Date $period
     * @return \Avido\PostNLCifClient\Request\SendTrack\ShippingStatus\StatusRequest
     */
    public function addPeriod(Date $period): StatusRequest
    {
        $this->periods[] = $period;
        return $this;
    }
    /**
     * Get Periods
     *
     * @access public
     * @return array
     */
    public function getPeriods(): array
    {
        return $this->periods;
    }
}
