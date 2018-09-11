<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Address.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Location Address
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

class Address extends BaseEntity
{
    /**
     * Type of the address.
     * Valid options:
     * 01 - receiver
     * 02 - sender
     * 03 - Alternative sender address
     * 04 - Collection address
     * 08 - Return address (When using the ‘label in the box return label’, it is mandatory to use an
     *                              Antwoordnummer in AddressType 08. This cannot be a regular address.)
     * 09 - Delivery address (for use with Pick up at PostNL location)
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     * @var string
     */
    protected $AddressType = null;
    /**
     * Area of the address
     * @var string
     */
    protected $Area = null;
    /**
     * Building name of the address
     * @var string
     */
    protected $Buildingname = null;
    /**
     * City of the address
     * @var string
     */
    protected $City = null;
    /**
     * This field has a dependency with the field Name. One of both fields must be filled mandatory; using
     * both fields is also allowed. Mandatory when AddressType is 09.
     * @var string
     */
    protected $CompanyName = null;
    /**
     * The ISO2 country codes
     * @var string
     */
    protected $Countrycode = null;
    /**
     * Send to specific department of a company.
     * @var string
     */
    protected $Department = null;
    /**
     * Door code of address. Mandatory for some international shipments.
     * @var string
     */
    protected $Doorcode = null;
    /**
     * Please add FirstName and Name (lastname) of the receiver to improve the parcel tracking experience of
     * your customer.
     * @var string
     */
    protected $Firstname = null;
    /**
     * Send to specific floor of a company
     * @var string
     */
    protected $Floor = null;
    /**
     * Mandatory for shipments to Benelux. Max. length is 5 characters (only for Benelux addresses).
     * For Benelux addresses,this field should always be numeric.
     * @var int
     */
    protected $HouseNr = null;
    /**
     * House number extension
     * @var string
     */
    protected $HouseNrExt = null;
    /**
     * Last name of person. This field has a dependency with the field CompanyName. One of both fields must
     * be filled mandatory; using both fields is also allowed. Remark: please add FirstName and Name (lastname)
     * of the receiver to improve the parcel tracking experience of your customer.
     * @var string
     */
    protected $Name = null;
    /**
     * Region of the address
     * @var string
     */
    protected $Region = null;
    /**
     * This field has a dependency with the field StreetHouseNrExt. One of both fields must be filled
     * mandatory; using both fields is also allowed.
     * @var string
     */
    protected $Street = null;
    /**
     * Combination of Street, HouseNr and HouseNrExt.
     * Please see Guidelines for the explanation.
     * @var string
     */
    protected $StreetHouseNrExt = null;
    /**
     * Zipcode of the address. Mandatory for shipments to Benelux. Max length (NL) 6 characters,(BE;LU)
     * 4 numeric characters
     * @var type
     */
    protected $Zipcode = null;
    
    // REBUILD
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
    
    /**
     * Set Address Type
     *
     * @access public
     * @param string $type
     * @return $this
     */
    public function setAddressType($type)
    {
        $this->AddressType = (string)$type;
        return $this;
    }
    
    /**
     * Get Address  Type
     *
     * @access public
     * @return string
     */
    public function getAddressType()
    {
        return (string)$this->AddressType;
    }
    
    /**
     * Set Address Area
     *
     * @access public
     * @param string $area
     * @return $this
     */
    public function setArea($area)
    {
        $this->Area = (string)$area;
        return $this;
    }
    
    /**
     * Get Address Area
     *
     * @access public
     * @return string
     */
    public function getArea()
    {
        return (string)$this->Area;
    }
    
    /**
     * Set address building name
     *
     * @access public
     * @param string $buildingname
     * @return $this
     */
    public function setBuildingname($buildingname)
    {
        $this->Buildingname = (string)$buildingname;
        return $this;
    }
    
    /**
     * Get Address Building Name
     *
     * @access public
     * @return string
     */
    public function getBuildingname()
    {
        return (string)$this->Buildingname;
    }
    
    /**
     * Set Address City
     *
     * @access public
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->City = (string)$city;
        return $this;
    }
    
    /**
     * Get Address City
     *
     * @access public
     * @return string
     */
    public function getCity()
    {
        return (string)$this->City;
    }
    
    /**
     * Set Address Companyname
     *
     * @access public
     * @param string $companyname
     * @return $this
     */
    public function setCompanyname($companyname)
    {
        $this->CompanyName = (string)$companyname;
        return $this;
    }
    
    /**
     * Get Address Companyname
     *
     * @access public
     * @return string
     */
    public function getCompanyname()
    {
        return (string)$this->CompanyName;
    }
    /**
     * Set Address Iso2 Country Code
     *
     * @access public
     * @param string $countrycode
     * @return $this
     */
    public function setCountrycode($countrycode)
    {
        $this->Countrycode = (string)$countrycode;
        return $this;
    }
    
    /**
     * Get Country Code
     *
     * @access public
     * @return string
     */
    public function getCountryCode()
    {
        return (string)$this->Countrycode;
    }
    
    /**
     * Set Address Company department
     *
     * @access public
     * @param string $department
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->Department = (string)$department;
        return $this;
    }
    
    /**
     * Get Address company department
     *
     * @access public
     * @return string
     */
    public function getDepartment()
    {
        return (string)$this->Department;
    }
    
    /**
     * Set Building Doorcode
     *
     * @access public
     * @param string $doorcode
     * @return $this
     */
    public function setDoorcode($doorcode)
    {
        $this->Doorcode = (string)$doorcode;
        return $this;
    }
    
    /**
     * Get Building doorcode
     *
     * @access public
     * @return string
     */
    public function getDoorcode()
    {
        return (string)$this->Doorcode;
    }
    
    /**
     * Set Address Firstname
     *
     * @access public
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->Firstname = (string)$firstname;
        return $this;
    }
    
    /**
     * Get Address Firstname
     *
     * @access public
     * @return string
     */
    public function getFirstname()
    {
        return (string)$this->Firstname;
    }
    
    /**
     * Set Address Building floor
     *
     * @access public
     * @param string $floor
     * @return $this
     */
    public function setFloor($floor)
    {
        $this->Floor = (string)$floor;
        return $this;
    }
    
    /**
     * Get Address Building Floor
     *
     * @access public
     * @return string
     */
    public function getFloor()
    {
        return (string)$this->Floor;
    }
    
    /**
     * Set Address Housenumber
     *
     * @access public
     * @param int $housenumber
     * @return $this
     */
    public function setHousenumber($housenumber)
    {
        $this->HouseNr = (int)$housenumber;
        return $this;
    }
    
    /**
     * Get Address Housenumber
     *
     * @access public
     * @return int
     */
    public function getHousenumber()
    {
        return (int)$this->HouseNr;
    }
    
    /**
     * Set Address Housenumber ext
     *
     * @access public
     * @param string $housenumber_ext
     * @return $this
     */
    public function setHousenumberExt($housenumber_ext)
    {
        $this->HouseNrExt = (string)$housenumber_ext;
        return $this;
    }
    
    /**
     * Get Address Housenumber ext
     *
     * @access public
     * @return string
     */
    public function getHousenumberExt()
    {
        return (string)$this->HouseNrExt;
    }
    
    /**
     * Set Address name
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
     * Get Address name
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return (string)$this->Name;
    }
    /**
     * Set Address Region
     *
     * @access public
     * @param string $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->Region = (string)$region;
        return $this;
    }
    
    /**
     * Get Address Region
     *
     * @access public
     * @return string
     */
    public function getRegion()
    {
        return (string)$this->Region;
    }
    
    /**
     * Set Address street
     *
     * @access public
     * @param string $street
     * @return $this
     */
    public function setStreet($street)
    {
        $this->Street = (string)$street;
        return $this;
    }
    
    /**
     * Get Address street
     *
     * @access public
     * @return string
     */
    public function getStreet()
    {
        return (string)$this->Street;
    }
    
    /**
     * Set Complete address (street + number + ext)
     *
     * @access public
     * @param string $address
     * @return $this
     */
    public function setStreetHouseNrExt($address)
    {
        $this->StreetHouseNrExt = (string)$address;
        return $this;
    }
    
    /**
     * Get Complete address (street + number + ext)
     *
     * @access public
     * @return string
     */
    public function getStreetHouseNrExt()
    {
        return (string)$this->StreetHouseNrExt;
    }
    
    /**
     * Set Address Zipcode
     *
     * @access public
     * @param type $zipcode
     * @return $this
     */
    public function setZipcode($zipcode)
    {
        $this->Zipcode = (string)$zipcode;
        return $this;
    }
    
    /**
     * Get Address Zipcode
     *
     * @access public
     * @return string
     */
    public function getZipcode()
    {
        return (string)$this->Zipcode;
    }
    
    /**
     * Return Entity as Array
     *
     * @access public
     * @return array
     */
    public function toArray()
    {
        return [
            'AddressType' => $this->getAddressType(),
            'Area' => $this->getArea(),
            'Buildingname' => $this->getBuildingname(),
            'City' => $this->getCity(),
            'CompanyName' => $this->getCompanyname(),
            'Countrycode' => $this->getCountryCode(),
            'Department' => $this->getDepartment(),
            'Doorcode' => $this->getDoorcode(),
            'FirstName' => $this->getFirstname(),
            'Floor' => $this->getFloor(),
            'HouseNr' => $this->getHousenumber(),
            'HouseNrExt' => $this->getHousenumberExt(),
            'Name' => $this->getName(),
            'Region' => $this->getRegion(),
            'Street' => $this->getStreet(),
            'StreetHouseNrExt' => $this->getStreetHouseNrExt(),
            'Zipcode' => $this->getZipcode()
        ];
    }
}
