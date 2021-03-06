<?php
namespace Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate;

/**
    @File: DeliverydateRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/delivery-options/deliverydate-webservice/documentation/
    @copyright   Avido

    Calculate delivery date
*/

use BadMethodCallException;

use Avido\PostNLCifClient\Request\BaseRequest;
use Avido\PostNLCifClient\Util\Date;

class DeliverydateRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'calculate/date/delivery';
    private $version = '2_2';

    private $validDayNames = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'shipping_date' => null,
            'shipping_duration' => null,
            'cut_off_time' => null,
            'postal_code' => null,
            'country_code' => null,
            'origin_country_code' => null,
            'city' => null,
            'street' => null,
            'house_number' => null,
            'house_nr_ext' => null,
            'options' => [],
            'cut_off_time_monday' => null,
            'available_monday' => null,
            'cut_off_time_tuesday' => null,
            'available_tuesday' => null,
            'cut_off_time_wednesday' => null,
            'available_wednesday' => null,
            'cut_off_time_thursday' => null,
            'available_thursday' => null,
            'cut_off_time_friday' => null,
            'available_friday' => null,
            'cut_off_time_saturday' => null,
            'available_saturday' => null,
            'cut_off_time_sunday' => null,
            'available_sunday' => null
        ];
    }

    /**
     * Set Shipping date
     *
     * @access public
     * @param string $date
     * @return $this
     */
    public function setShippingDate($date): DeliverydateRequest
    {
        if (!$date instanceof Date) {
            $date = new Date($date);
        }
        $this->arguments['shipping_date'] = $date->format('d-m-Y H:i:s');
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
    public function setShippingDuration(int $duration): DeliverydateRequest
    {
        $this->arguments['shipping_duration'] = $duration;
        return $this;
    }

    /**
     * Cut off times per day. At least one cut off time must be specified.

     * @param string $cut_off_time (format HH:ii:ss)
     * @param mixed null|string|array $day
     *          null = global cut off time
     *          dayOfWeek = single day
     *          array[dayOfWeek] = array of weekDays to set cutoff time for.
     *
     *      Examples:
     *          Single day cut off time
     *              ->setCutOffTime('14:00:00', 'wednesday');
     *
     *          Multiple days
     *              ->setCutOffTime('14:00:00', ['monday', 'wednesday', 'friday']);
     * @return $this
     */
    public function setCutOffTime(string $cut_off_time, $day = null): DeliverydateRequest
    {
        if (!preg_match("/[0-9]{2}:[0-9]{2}:[0-9]{2}/", $cut_off_time)) {
            throw new BadMethodCallException("Wrong cut off time format, use: HH:ii:ss");
        }
        if (is_null($day)) {// global cut off time
            $this->arguments['cut_off_time'] = $cut_off_time;
        } else {
            if (is_array($day)) {
                foreach ($day as $dayName) {
                    $dayName = strtolower($dayName);
                    if (in_array($dayName, $this->validDayNames)) {
                        $this->arguments["cut_off_time_{$dayName}"] = $cut_off_time;
                    }
                }
            } else {
                $dayName = strtolower($day);
                if (in_array($dayName, $this->validDayNames)) {
                    $this->arguments["cut_off_time_{$dayName}"] = $cut_off_time;
                }
            }
        }
        return $this;
    }

    /**
     * Set Postal code
     *
     * @access public
     * @param string $postal_code
     * @return $this
     */
    public function setPostalCode(string $postal_code): DeliverydateRequest
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
    public function setCountryCode(string $country_code): DeliverydateRequest
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
    public function setOriginCountryCode(string $origin_country_code): DeliverydateRequest
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
    public function setCity(string $city): DeliverydateRequest
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
    public function setStreet(string $street): DeliverydateRequest
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
    public function setHouseNumber(int $house_number): DeliverydateRequest
    {
        $this->arguments['house_number'] = $house_number;
        return $this;
    }

    /**
     * Set housenumber ext
     *
     * @access public
     * @param string $house_nr_ext
     * @return $this
     */
    public function setHouseNumberExt(string $house_nr_ext): DeliverydateRequest
    {
        $this->arguments['house_nr_ext'] = $house_nr_ext;
        return $this;
    }

    /**
     * Add delivery option
     *
     * @access public
     * @param string  $option
     * @return $this
     */
    public function addDeliveryOption(string $option): DeliverydateRequest
    {
        if ($this->isValidDeliveryOption($option, 'deliverydate') && !in_array($option, $this->arguments['options'])) {
            $this->arguments['options'][] = $option;
        }
        return $this;
    }

    public function setCutOffTimeMonday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'monday');
    }

    public function setCutOffTimeTuesday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'tuesday');
    }

    public function setCutOffTimeWednesday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'wednesday');
    }

    public function setCutOffTimeThursday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'thursday');
    }

    public function setCutOffTimeFriday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'friday');
    }

    public function setCutOffTimeSaturday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'saturday');
    }

    public function setCutOffTimeSunday(string $time): DeliverydateRequest
    {
        return $this->setCutOffTime($time, 'sunday');
    }

    public function setAvailableMonday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_monday'] = $available;
        return $this;
    }

    public function setAvailableTuesday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_tuesday'] = $available;
        return $this;
    }

    public function setAvailableWednesday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_wednesday'] = $available;
        return $this;
    }

    public function setAvailableThursday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_thursday'] = $available;
        return $this;
    }

    public function setAvailableFriday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_friday'] = $available;
        return $this;
    }

    public function setAvailableSaturday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_saturday'] = $available;
        return $this;
    }

    public function setAvailableSunday(bool $available): DeliverydateRequest
    {
        $this->arguments['available_sunday'] = $available;
        return $this;
    }
}
