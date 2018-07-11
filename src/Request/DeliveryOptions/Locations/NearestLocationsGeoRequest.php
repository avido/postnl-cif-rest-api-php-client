<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Locations;
/**
    @File: NearestLocationsGeoRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
    @copyright   Avido
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class NearestLocationsGeoRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'locations/nearest/geocode';
    private $version = '2_1';

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'country_code' => null,
            'latitude' => null,
            'longitude' => null,
            'delivery_date' => null,
            'opening_time' => null,
            'delivery_options' => []
        ];
    }
    
    /**
     * Set Country Code (ISO 3166-1 alpha-2.)
     * 
     * @access public
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     * @param string $country_code
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->arguments['country_code'] = $country_code;
        return $this;
    }
    
    public function setLatitude($latitude)
    {
        $this->arguments['latitude'] = $latitude;
        return $this;
    }
    
    public function setLongitude($longitude)
    {
        $this->arguments['longitude'] = $longitude;
        return $this;
    }

    /**
     * Set Delivery date
     * 
     * @access public
     * @param string $delivery_date
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->arguments['delivery_date'] = $delivery_date;
        return $this;
    }
    
    /**
     * Set Opening Time
     * 
     * @access public
     * @param string $opening_time
     * @return $this
     */
    public function setOpeningTime($opening_time)
    {
        $this->arguments['opening_time'] = $opening_time;
        return $this;
    }
    
    /**
     * Add delivery option 
     * 
     * @access public
     * @param string $option
     * @return $this
     */
    public function addDeliveryOptions($option)
    {
        if ($this->isValidDeliveryOption($option) && !in_array($option, $this->arguments['delivery_options'])) {
            $this->arguments['delivery_options'][] = $option;
        }
        return $this;
    }
    
    public function getDeliveryOptions()
    {
        return implode(",", $this->arguments['delivery_options']);
    }
}
