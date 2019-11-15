<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Locations;

/**
    @File: LocationRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
    @copyright   Avido

    Lookup location details
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class LocationRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'locations/lookup';
    private $version = '2_1';

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        // or
//        $this->setEndpoint('shipment')
//        ->setPath('path')
//            ->setVersion('2_1');
        $this->arguments = [
            'location_code' => null,
            'retail_network_id' => null
        ];
    }

    /**
     * Set Location Code
     *
     * Codes can be obtained from the Location requests calls
     *
     * @access public
     * @param string $location_code
     * @return $this
     */
    public function setLocationCode(string $location_code): LocationRequest
    {
        $this->arguments['location_code'] = $location_code;
        return $this;
    }

    /**
     * Set Retail Network Id
     *
     * @access public
     * @param string $retail_network_id
     * @return $this
     */
    public function setRetailNetworkId(string $retail_network_id): LocationRequest
    {
        $this->arguments['retail_network_id'] = $retail_network_id;
        return $this;
    }
}
