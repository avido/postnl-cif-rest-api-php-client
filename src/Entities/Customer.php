<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Customer.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Customer Entity
  @Dependencies:
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;
use Avido\PostNLCifClient\Entities\Address;

class Customer extends BaseEntity
{
    protected $Address = null;
    /**
     * Code of delivery location at PostNL Pakketten
     * @var string
     */
    protected $CollectionLocation = null;
    protected $ContactPerson = null;
    /**
     * Customer code as known at PostNL Pakketten
     * @var string
     */
    protected $CustomerCode = null;
    /**
     * Customer number as known at PostNL Pakketten
     * @var string
     */
    protected $CustomerNumber = null;
    protected $Email = null;
    protected $Name = null;

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * Set Address
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Address $address
     * @return $this
     */
    public function setAddress(Address $address): Customer
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
    public function getAddress(): Address
    {
        return $this->Address;
    }


    /**
     * Set Collection Location
     *
     * @access public
     * @param string $collection_location
     * @return $this
     */
    public function setCollectionLocation(string $collection_location): Customer
    {
        $this->CollectionLocation = $collection_location;
        return $this;
    }

    /**
     * Get Collection Location
     *
     * @access public
     * @return string
     */
    public function getCollectionLocation(): string
    {
        return $this->CollectionLocation ?? '';
    }


    /**
     * Set Contact Person
     *
     * @access public
     * @param string $contact_person
     * @return $this
     */
    public function setContactPerson(string $contact_person): Customer
    {
        $this->ContactPerson = $contact_person;
        return $this;
    }

    /**
     * Get Contact Person
     *
     * @access public
     * @return string
     */
    public function getContactPerson(): string
    {
        return $this->ContactPerson ?? '';
    }

    /**
     * Set Customer Code
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode(string $customer_code): Customer
    {
        $this->CustomerCode = $customer_code;
        return $this;
    }

    /**
     * Get Customer Code
     *
     * @access public
     * @return string
     */
    public function getCustomerCode(): string
    {
        return $this->CustomerCode ?? '';
    }

    /**
     * Set Customer Number
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber(string $customer_number): Customer
    {
        $this->CustomerNumber = $customer_number;
        return $this;
    }

    /**
     * Get Customer Number
     *
     * @access public
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->CustomerNumber ?? '';
    }

    /**
     * Set Email address
     *
     * @access public
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): Customer
    {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get Email Address
     *
     * @access public
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email ?? '';
    }

    /**
     * Set Name
     *
     * @access public
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Customer
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @access public
     * @return string
     */
    public function getName(): string
    {
        return $this->Name ?? '';
    }

    /**
     * Return Customer Entity as array
     *
     * @access public
     * @return array
     */
    public function toArray(): array
    {
        return [
            'Address' => !is_null($this->getAddress()) ? $this->getAddress()->toArray() : null,
            'CollectionLocation' => $this->getCollectionLocation(),
            'ContactPerson' => $this->getContactPerson(),
            'CustomerCode' => $this->getCustomerCode(),
            'CustomerNumber' => $this->getCustomerNumber(),
            'Email' => $this->getEmail(),
            'Name' => $this->getName()
        ];
    }
}
