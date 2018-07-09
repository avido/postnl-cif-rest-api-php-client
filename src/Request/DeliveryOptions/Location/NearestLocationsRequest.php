<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Location;
/**
    @File: CreditRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
    @copyright   Avido
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class NearestLocationsRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'locations/nearest';
    private $version = '2_1';

    // arguments
    private $arguments = [
        'country_code' => null,
        'postalcode' => null,
        'city' => null,
        'street' => null,
        'house_number' => null,
        'delivery_date' => null,
        'opening_time' => null,
        'delivery_options' => []
    ];
    
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        // or 
//        $this->setEndpoint('shipment')
//        ->setPath('path')
//            ->setVersion('2_1');
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
    
    /**
     * Set Postal code
     * @param string $postalcode
     * @return $this
     */
    public function setPostalcode($postalcode)
    {
        $this->arguments['postalcode'] = $postalcode;
        return $this;
    }
    
    /**
     * Set City 
     * 
     * @access public
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->arguments['city'] = $city;
        return $this;
    }
    
    /**
     * Set Street
     * 
     * @access public
     * @param strung $street
     * @return $this
     */
    public function setStreet($street)
    {
        $this->arguments['street'] = $street;
        return $this;
    }
    
    /**
     * Set Housenumber
     * 
     * @access public
     * @param string $house_number
     * @return $this
     */
    public function setHouseNumber($house_number)
    {
        $this->arguments['house_number'] = (int)$house_number;
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
    
    /**
     * Get Arguments for request
     * @return array
     */
    public function getArguments()
    {
        // reformat delivery options
        $arguments = $this->arguments;
        $arguments['delivery_options'] = $this->getDeliveryOptions();
        return (array)$arguments;
    }
    
    public function getDeliveryOptions()
    {
        return implode(",", $this->arguments['delivery_options']);
    }
}
