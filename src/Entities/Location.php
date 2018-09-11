<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Location.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Location
  @Dependencies:
    Base Entity
 */
use Avido\PostNLCifClient\Entities\BaseEntity;

use Avido\PostNLCifClient\Entities\Address;

class Location extends BaseEntity
{
    /**
     * Location Code
     * @var Int
     */
    protected $LocationCode = null;
    /**
     * Name
     * @var String
     */
    protected $Name = null;
    /**
     * The distance from this location to the address entered in the request (in meters).
     * @var Int
     */
    protected $Distance = null;
    /**
     * The latitude of the location
     * @var Float
     */
    protected $Latitude = null;
    /**
     * The longitude of the location
     * @var Float
     */
    protected $Longitude = null;
    /**
     * Address of location
     * @var Entity/Address
     */
    protected $Address = null;
    /**
     * One or more delivery options. See the Guidelines for possible values.
     * @var Array
     */
    protected $DeliveryOptions = null;
    /**
     * Opening hours of Location
     * @var Array
     */
    protected $OpeningHours = null;
    /**
     * Partnername of the location
     * @var String
     */
    protected $PartnerName = null;
    /**
     * Phone number of the location
     * @var String
     */
    protected $PhoneNumber = null;
    /**
     * The network ID used for this retail location
     * @var String
     */
    protected $RetailNetworkID = null;
    /**
     * The sales channel used for this location
     * @var String
     */
    protected $Saleschannel = null;
    /**
     * The terminal type used by this location
     * @var String
     */
    protected $TerminalType = null;

    public function __construct($data = [])
    {
        parent::__construct($data);
        
        // address
        $address = new Address($data['Address']);
        $this->setAddress($address);
        
        if (isset($data['DeliveryOptions']) &&
            isset($data['DeliveryOptions']['string']) &&
            is_array($data['DeliveryOptions']['string'])
        ) {
            $this->setDeliveryOptions($data['DeliveryOptions']['string']);
        }
//        die("X");
        $openingHours = [];
        if (isset($data['OpeningHours']) && is_array($data['OpeningHours'])) {
            // reformat opening hours
            $openingHours = [];
            foreach ($data['OpeningHours'] as $day => $time) {
                if (!isset($openingHours[strtolower($day)])) {
                    $openingHours[strtolower($day)] = [];
                }
                if (isset($time['string'])) {
                    // multiple times?
                    if (is_array($time['string'])) {
                        foreach ($time['string'] as $item) {
                            list($from, $till) = explode("-", $item);
                            $openingHours[strtolower($day)][] = [$from => $till];
                        }
                    } else {
                        list($from, $till) = explode("-", $time['string']);
                        $openingHours[strtolower($day)][] = [$from => $till];
                    }
                }
            }
            $this->setOpeningHours($openingHours);
        }
    }
    
    /**
     * Get Location Code
     *
     * @access public
     * @param int $code
     * @return $this
     */
    public function setLocationCode($code)
    {
        $this->LocationCode = (int)$code;
        return $this;
    }
    
    /**
     * Get LocationCode
     *
     * @access public
     * @return int
     */
    public function getLocationCode()
    {
        return (int)$this->LocationCode;
    }
    
    /**
     * Set Name
     *
     * @access public
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->Name = (string)$name;
        return $this;
    }
    
    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return (string)$this->Name;
    }
    
    /**
     * Set Distance
     *
     * @access public
     * @param int $distance
     * @return $this
     */
    public function setDistance($distance)
    {
        $this->Distance = (int)$distance;
        return $this;
    }
    
    /**
     * Get Distance
     *
     * @access public
     * @return int
     */
    public function getDistance()
    {
        return (int)$this->Distance;
    }
    
    /**
     * Set Latitude
     *
     * @access public
     * @param float $lat
     * @return $this
     */
    public function setLatitude($lat)
    {
        $this->Latitude = (float)$lat;
        return $this;
    }
    
    /**
     * Get Latitude
     *
     * @access public
     * @return float
     */
    public function getLatitude()
    {
        return (float)$this->Latitude;
    }
    
    /**
     * Set Longitude
     *
     * @access public
     * @param float $long
     * @return $this
     */
    public function setLongitude($long)
    {
        $this->Longitude = (float)$long;
        return $this;
    }
    
    /**
     * Get Longitude
     *
     * @access public
     * @return float
     */
    public function getLongitude()
    {
        return (float)$this->Longitude;
    }
    
    /**
     * Set Address
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->Address = $address;
        return $this;
    }
    /**
     * Get Address
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Address
     */
    public function getAddress()
    {
        return $this->Address;
    }
    
    /**
     * Set DeliveryOptions
     *
     * @access public
     * @param array $options
     * @return $this
     */
    public function setDeliveryOptions($options)
    {
        $this->DeliveryOptions = (array)$options;
        return $this;
    }
    
    /**
     * Get DeliveryOptions
     *
     * @access public
     * @return array
     */
    public function getDeliveryOptions()
    {
        return (array)$this->DeliveryOptions;
    }
    
    /**
     * Set OpeningHours
     *
     * @access public
     * @param array $hours
     * @return $this
     */
    public function setOpeningHours($hours)
    {
        $this->OpeningHours = (array)$hours;
        return $this;
    }
    
    /**
     * Get OpeningHours
     *
     * @access public
     * @return array
     */
    public function getOpeningHours()
    {
        return (array)$this->OpeningHours;
    }
    
    /**
     * Set PartnerName
     *
     * @access public
     * @param string $name
     * @return $this
     */
    public function setPartnerName($name)
    {
        $this->PartnerName = (string)$name;
        return $this;
    }
    
    /**
     * Get PartnerName
     *
     * @access public
     * @return string
     */
    public function getPartnerName()
    {
        return (string)$this->PartnerName;
    }
    
    /**
     * Set Phonenumber
     *
     * @access public
     * @param string $phonenumber
     * @return $this
     */
    public function setPhoneNumber($phonenumber)
    {
        $this->PhoneNumber = (string)$phonenumber;
        return $this;
    }
    
    /**
     * Get PhoneNumber
     *
     * @access public
     * @return string
     */
    public function getPhoneNumber()
    {
        return (string)$this->PhoneNumber;
    }
    
    /**
     * Set RetailNetworkID
     *
     * @access public
     * @param string $retail_network_id
     * @return $this
     */
    public function setRetailNetworkID($retail_network_id)
    {
        $this->RetailNetworkID = (string)$retail_network_id;
        return $this;
    }
    
    /**
     * Get RetailNetworkID
     *
     * @access public
     * @return string
     */
    public function getRetailNetworkID()
    {
        return (string)$this->RetailNetworkID;
    }
    
    /**
     * Set Saleschannel
     *
     * @access public
     * @param string $channel
     * @return $this
     */
    public function setSaleschannel($channel)
    {
        $this->Saleschannel = (string)$channel;
        return $this;
    }
    
    /**
     * Get Saleschannel
     *
     * @access public
     * @return string
     */
    public function getSaleschannel()
    {
        return (string)$this->Saleschannel;
    }
    
    /**
     * Set TerminalType
     *
     * @access public
     * @param string $terminal_type
     * @return $this
     */
    public function setTerminalType($terminal_type)
    {
        $this->TerminalType = (string)$terminal_type;
        return $this;
    }
    
    /**
     * Get TerminalType
     *
     * @access public
     * @return string
     */
    public function getTerminalType()
    {
        return (string)$this->TerminalType;
    }
}
