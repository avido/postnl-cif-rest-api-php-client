<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Timeframe;

/**
    @File: TimeframeRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/timeframe-webservice/documentation/
    @copyright   Avido
*/

use Avido\PostNLCifClient\Request\BaseRequest;
use Avido\PostNLCifClient\Util\Date;

class TimeframeRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'calculate/timeframes';
    private $version = '2_1';

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'allow_sunday_sorting' => null,
            'start_date' => null,
            'end_date' => null,
            'postal_code' => null,
            'interval' => null, //Filter for MyTime shipments (possible: 60/30);
                                    //choose 60 if you only want ‘whole hour’ timeframes returned
            'house_number' => null,
            'house_nr_ext' => null,
            'timeframe_range' => null,
            'street' => null,
            'city' => null,
            'country_code' => null,
            'options' => []
        ];
    }
    
    public function setAllowSundaySorting($allow_sunday_sorting)
    {
        $this->arguments['allow_sunday_sorting'] = (bool)$allow_sunday_sorting;
        return $this;
    }
    
    public function setStartDate($date)
    {
        $date = new Date($date);
        $this->arguments['start_date'] = $date->format('d-m-Y');
        return $this;
    }
    
    public function setEndDate($date)
    {
        $date = new Date($date);
        $this->arguments['end_date'] = $date->format('d-m-Y');
        return $this;
    }
    
    /**
     * Set Postal code
     *
     * @access public
     * @param string $postalcode
     * @return $this
     */
    public function setPostalcode($postalcode)
    {
        $this->arguments['postal_code'] = $postalcode;
        return $this;
    }
    
    public function setInterval($interval)
    {
        if ($interval%30) {
            $this->arguments['interval'] = $interval;
        }
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
     * Set Housenumber Ext
     *
     * @access public
     * @param string $house_number
     * @return $this
     */
    public function setHouseNumberExt($ext)
    {
        $this->arguments['house_nr_ext'] = $ext;
        return $this;
    }
    
    public function setTimeframeRange($range)
    {
        $this->arguments['timeframe_range'] = $range;
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
    public function addDeliveryOption($option)
    {
        if ($this->isValidDeliveryOption($option, 'timeframe') && !in_array($option, $this->arguments['options'])) {
            $this->arguments['options'][] = $option;
        }
        return $this;
    }
    
    public function getDeliveryOptions()
    {
        return implode(",", $this->arguments['options']);
    }
    
    public function getArguments()
    {
        $arguments = parent::getArguments();
        $arguments['Options'] = $this->getDeliveryOptions();
        return $arguments;
    }
}
