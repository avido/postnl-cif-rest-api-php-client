<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Locations;

/**
    @File: NearestLocationsAreaRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
    @copyright   Avido
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class NearestLocationsAreaRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'locations/area';
    private $version = '2_1';

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'country_code' => null,
            'latitude_north' => null,
            'latitude_east' => null,
            'latitude_south' => null,
            'latitude_west' => null,
            'longitude_north' => null,
            'longitude_east' => null,
            'longitude_south' => null,
            'longitude_west' => null,
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
    
    /**
     * Set Latitude (array North, Easy, South, West)
     *
     * @param array $latitude
     * @return $this
     */
    public function setLatitude(array $latitude)
    {
        $this->setLatitudeNorth(isset($latitude[0]) ? $latitude[0] : null);
        $this->setLatitudeEast(isset($latitude[1]) ? $latitude[1] : null);
        $this->setLatitudeSouth(isset($latitude[2]) ? $latitude[2] : null);
        $this->setLatitudeWest(isset($latitude[3]) ? $latitude[3] : null);
        return $this;
    }

    /**
     * Set Longitude (array North, Easy, South, West)
     *
     * @param array $longitude
     * @return $this
     */
    public function setLongitude(array $longitude)
    {
        $this->setLongitudeNorth(isset($longitude[0]) ? $longitude[0] : null);
        $this->setLongitudeEast(isset($longitude[1]) ? $longitude[1] : null);
        $this->setLongitudeSouth(isset($longitude[2]) ? $longitude[2] : null);
        $this->setLongitudeWest(isset($longitude[3]) ? $longitude[3] : null);
        return $this;
    }

    /**
     * Set Latitude north
     *
     * @access public
     * @param float $latitude
     * @return $this
     */
    public function setLatitudeNorth($latitude)
    {
        $this->arguments['latitude_north'] = $latitude;
        return $this;
    }

    /**
     * Set Latitude east
     *
     * @access public
     * @param float $latitude
     * @return $this
     */
    public function setLatitudeEast($latitude)
    {
        $this->arguments['latitude_east'] = $latitude;
        return $this;
    }

    /**
     * Set Latitude south
     *
     * @access public
     * @param float $latitude
     * @return $this
     */
    public function setLatitudeSouth($latitude)
    {
        $this->arguments['latitude_south'] = $latitude;
        return $this;
    }

    /**
     * Set Latitude west
     *
     * @access public
     * @param float $latitude
     * @return $this
     */
    public function setLatitudeWest($latitude)
    {
        $this->arguments['latitude_west'] = $latitude;
        return $this;
    }

    /**
     * Set Longitude north
     *
     * @access public
     * @param float $longitude
     * @return $this
     */
    public function setLongitudeNorth($longitude)
    {
        $this->arguments['longitude_north'] = $longitude;
        return $this;
    }

    /**
     * Set Longitude east
     *
     * @access public
     * @param float $longitude
     * @return $this
     */
    public function setLongitudeEast($longitude)
    {
        $this->arguments['longitude_east'] = $longitude;
        return $this;
    }

    /**
     * Set Longitude south
     *
     * @access public
     * @param float $longitude
     * @return $this
     */
    public function setLongitudeSouth($longitude)
    {
        $this->arguments['longitude_south'] = $longitude;
        return $this;
    }

    /**
     * Set Longitude west
     *
     * @access public
     * @param float $longitude
     * @return $this
     */
    public function setLongitudeWest($longitude)
    {
        $this->arguments['longitude_west'] = $longitude;
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
