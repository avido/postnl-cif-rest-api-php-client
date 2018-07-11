<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate;

/**
    @File: ShippingdateRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/deliverydate-webservice/documentation/
    @copyright   Avido

    Calculate Shipping date
*/

use BadMethodCallException;

use Avido\PostNLCifClient\Request\BaseRequest;
use Avido\PostNLCifClient\Util\Date;

class ShippingdateRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'calculate/date/shipping';
    private $version = '2_2';

    private $validDayNames = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'delivery_date' => null,
            'shipping_duration' => null,
            'postal_code' => null,
            'country_code' => null,
            'origin_country_code' => null,
            'city' => null,
            'street' => null,
            'house_number' => null,
            'house_nr_ext' => null
        ];
    }
    
    /**
     * Set Requested delivery date
     *
     * @access public
     * @param string $date
     * @return $this
     */
    public function setDeliveryDate($date)
    {
        if (!$date instanceof Date) {
            $date = new Date($date);
        }
        $this->arguments['delivery_date'] = $date->format('d-m-Y');
        return $this;
    }
    
    /**
     * The duration it takes for the shipment to be delivered to PostNL in days. A value of 1 means that the
     * parcel will be delivered to PostNL on the same day as
     * the date specified in ShippingDate. A value of 2 means the parcel will arrive at PostNL a day later etc.
     *
     * @access public
     * @param int $duration
     * @return $this
     */
    public function setShippingDuration($duration)
    {
        $this->arguments['shipping_duration'] = (int)$duration;
        return $this;
    }

    /**
     * Set Postal code
     *
     * @access public
     * @param string $postal_code
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->arguments['postal_code'] = $postal_code;
        return $this;
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
     * Set Origin Country Code (ISO 3166-1 alpha-2.)
     *
     * @access public
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     * @param string $origin_country_code
     * @return $this
     */
    public function setOriginCountryCode($origin_country_code)
    {
        $this->arguments['origin_country_code'] = $origin_country_code;
        return $this;
    }

    /**
     * Set city
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
     * Set street
     *
     * @access public
     * @param string $street
     * @return $this
     */
    public function setStreet($street)
    {
        $this->arguments['street'] = $street;
        return $this;
    }
    
    /**
     * Set housenumber
     *
     * @access public
     * @param int $house_number
     * @return $this
     */
    public function setHouseNumber($house_number)
    {
        $this->arguments['house_number'] = (int)$house_number;
        return $this;
    }

    /**
     * Set housenumber ext
     *
     * @access public
     * @param string $house_nr_ext
     * @return $this
     */
    public function setHouseNumberExt($house_nr_ext)
    {
        $this->arguments['house_nr_ext'] = $house_nr_ext;
        return $this;
    }
}
