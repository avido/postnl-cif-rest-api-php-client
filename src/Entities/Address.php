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
    const RECEIVER = "01";
    const SENDER = "02";
    const ALTERNATIVE_SENDER = "03";
    const COLLECTION_ADDRESS = "04";
    const RETURN_ADDRESS = "08";
    const PICKUP_LOCATION = "09";

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
     * Optional Remark about address
     * @var string
     */
    protected $Remark = null;

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
    public function setAddressType(string $type): Address
    {
        $this->AddressType = $type;
        return $this;
    }

    /**
     * Get Address  Type
     *
     * @access public
     * @return string
     */
    public function getAddressType(): string
    {
        return $this->AddressType ?? '';
    }

    /**
     * Set Address Area
     *
     * @access public
     * @param string $area
     * @return $this
     */
    public function setArea(string $area): Address
    {
        $this->Area = $area;
        return $this;
    }

    /**
     * Get Address Area
     *
     * @access public
     * @return string
     */
    public function getArea(): string
    {
        return $this->Area ?? '';
    }

    /**
     * Set address building name
     *
     * @access public
     * @param string $buildingname
     * @return $this
     */
    public function setBuildingname(string $buildingname): Address
    {
        $this->Buildingname = $buildingname;
        return $this;
    }

    /**
     * Get Address Building Name
     *
     * @access public
     * @return string
     */
    public function getBuildingname(): string
    {
        return $this->Buildingname ?? '';
    }

    /**
     * Set Address City
     *
     * @access public
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): Address
    {
        $this->City = $city;
        return $this;
    }

    /**
     * Get Address City
     *
     * @access public
     * @return string
     */
    public function getCity(): string
    {
        return $this->City ?? '';
    }

    /**
     * Set Address Companyname
     *
     * @access public
     * @param string $companyname
     * @return $this
     */
    public function setCompanyname(string $companyname): Address
    {
        $this->CompanyName = $companyname;
        return $this;
    }

    /**
     * Get Address Companyname
     *
     * @access public
     * @return string
     */
    public function getCompanyname(): string
    {
        return $this->CompanyName ?? '';
    }
    /**
     * Set Address Iso2 Country Code
     *
     * @access public
     * @param string $countrycode
     * @return $this
     */
    public function setCountrycode(string $countrycode): Address
    {
        $this->Countrycode = $countrycode;
        return $this;
    }

    /**
     * Get Country Code
     *
     * @access public
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->Countrycode ?? '';
    }

    /**
     * Set Address Company department
     *
     * @access public
     * @param string $department
     * @return $this
     */
    public function setDepartment(string $department): Address
    {
        $this->Department = $department;
        return $this;
    }

    /**
     * Get Address company department
     *
     * @access public
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->Department ?? '';
    }

    /**
     * Set Building Doorcode
     *
     * @access public
     * @param string $doorcode
     * @return $this
     */
    public function setDoorcode(string $doorcode): Address
    {
        $this->Doorcode = $doorcode;
        return $this;
    }

    /**
     * Get Building doorcode
     *
     * @access public
     * @return string
     */
    public function getDoorcode(): string
    {
        return $this->Doorcode ?? '';
    }

    /**
     * Set Address Firstname
     *
     * @access public
     * @param string $firstname
     * @return $this
     */
    public function setFirstname(string $firstname): Address
    {
        $this->Firstname = $firstname;
        return $this;
    }

    /**
     * Get Address Firstname
     *
     * @access public
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->Firstname ?? '';
    }

    /**
     * Set Address Building floor
     *
     * @access public
     * @param string $floor
     * @return $this
     */
    public function setFloor(string $floor): Address
    {
        $this->Floor = $floor;
        return $this;
    }

    /**
     * Get Address Building Floor
     *
     * @access public
     * @return string
     */
    public function getFloor(): string
    {
        return $this->Floor ?? '';
    }

    /**
     * Set Address Housenumber
     *
     * @access public
     * @param int $housenumber
     * @return $this
     */
    public function setHousenumber(int $housenumber): Address
    {
        $this->HouseNr = $housenumber;
        return $this;
    }

    /**
     * Get Address Housenumber
     *
     * @access public
     * @return int
     */
    public function getHousenumber(): int
    {
        return $this->HouseNr ?? 0;
    }

    /**
     * Set Address Housenumber ext
     *
     * @access public
     * @param string $housenumber_ext
     * @return $this
     */
    public function setHousenumberExt(string $housenumber_ext): Address
    {
        $this->HouseNrExt = $housenumber_ext;
        return $this;
    }

    /**
     * Get Address Housenumber ext
     *
     * @access public
     * @return string
     */
    public function getHousenumberExt(): string
    {
        return $this->HouseNrExt ?? '';
    }

    /**
     * Set Remark
     *
     * @access public
     * @param string $remark
     * @return $this
     */
    public function setRemark(string $remark): Address
    {
        $this->Remark = $remark;
        return $this;
    }

    /**
     * Get Remark
     *
     * @access public
     * @return string
     */
    public function getRemark(): string
    {
        return $this->Remark ?? '';
    }

    /**
     * Set Address name
     *
     * @access public
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Address
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get Address name
     *
     * @access public
     * @return string
     */
    public function getName(): string
    {
        return $this->Name ?? '';
    }
    /**
     * Set Address Region
     *
     * @access public
     * @param string $region
     * @return $this
     */
    public function setRegion(string $region): Address
    {
        $this->Region = $region;
        return $this;
    }

    /**
     * Get Address Region
     *
     * @access public
     * @return string
     */
    public function getRegion(): string
    {
        return $this->Region ?? '';
    }

    /**
     * Set Address street
     *
     * @access public
     * @param string $street
     * @return $this
     */
    public function setStreet(string $street): Address
    {
        $this->Street = $street;
        return $this;
    }

    /**
     * Get Address street
     *
     * @access public
     * @return string
     */
    public function getStreet(): string
    {
        return $this->Street ?? '';
    }

    /**
     * Set Complete address (street + number + ext)
     *
     * @access public
     * @param string $address
     * @return $this
     */
    public function setStreetHouseNrExt(string $address): Address
    {
        $this->StreetHouseNrExt = $address;
        return $this;
    }

    /**
     * Get Complete address (street + number + ext)
     *
     * @access public
     * @return string
     */
    public function getStreetHouseNrExt(): string
    {
        return $this->StreetHouseNrExt ?? '';
    }

    /**
     * Set Address Zipcode
     *
     * @access public
     * @param type $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode): Address
    {
        $this->Zipcode = $zipcode;
        return $this;
    }

    /**
     * Get Address Zipcode
     *
     * @access public
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->Zipcode ?? '';
    }

    /**
     * Return Entity as Array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
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
            'Remark' => $this->getRemark(),
            'Name' => $this->getName(),
            'Region' => $this->getRegion(),
            'Street' => $this->getStreet(),
            'StreetHouseNrExt' => $this->getStreetHouseNrExt(),
            'Zipcode' => $this->getZipcode()
        ];
    }
}
