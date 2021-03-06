<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Locations;

/**
    @File: NearestLocationsRequest.php
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

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        // or
//        $this->setEndpoint('shipment')
//        ->setPath('path')
//            ->setVersion('2_1');
        $this->arguments = [
            'country_code' => null,
            'postal_code' => null,
            'city' => null,
            'street' => null,
            'house_number' => null,
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
    public function setCountryCode(string $country_code): NearestLocationsRequest
    {
        $this->arguments['country_code'] = $country_code;
        return $this;
    }

    /**
     * Set Postal code
     * @param string $postalcode
     * @return $this
     */
    public function setPostalcode(string $postalcode): NearestLocationsRequest
    {
        $this->arguments['postal_code'] = $postalcode;
        return $this;
    }

    /**
     * Set City
     *
     * @access public
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): NearestLocationsRequest
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
    public function setStreet(string $street): NearestLocationsRequest
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
    public function setHouseNumber(int $house_number): NearestLocationsRequest
    {
        $this->arguments['house_number'] = $house_number;
        return $this;
    }

    /**
     * Set Delivery date
     *
     * @access public
     * @param string $delivery_date
     * @return $this
     */
    public function setDeliveryDate(string $delivery_date): NearestLocationsRequest
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
    public function setOpeningTime(string $opening_time): NearestLocationsRequest
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
    public function addDeliveryOptions(string $option): NearestLocationsRequest
    {
        if ($this->isValidDeliveryOption($option) && !in_array($option, $this->arguments['delivery_options'])) {
            $this->arguments['delivery_options'][] = $option;
        }
        return $this;
    }

    public function getDeliveryOptions(): string
    {
        return implode(",", $this->arguments['delivery_options']);
    }
}
