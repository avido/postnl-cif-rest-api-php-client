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
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;
use Avido\PostNLCifClient\Entities\Address;

class Customer extends BaseModel
{
    private $Address = null;
    /**
     * Code of delivery location at PostNL Pakketten
     * @var string
     */
    private $CollectionLocation = null;
    private $ContactPerson = null;
    /**
     * Customer code as known at PostNL Pakketten
     * @var string
     */
    private $CustomerCode = null;
    /**
     * Customer number as known at PostNL Pakketten
     * @var string
     */
    private $CustomerNumber = null;
    private $Email = null;
    private $Name = null;
    
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
    public function setAddress(Address $address)
    {
        $this->Address = $address;
        return $this;
    }
    
    /**
     * Set Collection Location
     *
     * @access public
     * @param string $collection_location
     * @return $this
     */
    public function setCollectionLocation($collection_location)
    {
        $this->CollectionLocation = $collection_location;
        return $this;
    }
    
    /**
     * Set Contact Person
     *
     * @access public
     * @param string $contact_person
     * @return $this
     */
    public function setContactPerson($contact_person)
    {
        $this->ContactPerson = $contact_person;
        return $this;
    }
    
    /**
     * Set Customer Number
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->CustomerNumber = $customer_number;
        return $this;
    }
    
    /**
     * Set Customer Code
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode($customer_code)
    {
        $this->CustomerCode = $customer_code;
        return $this;
    }
    
    /**
     * Set Email address
     *
     * @access public
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->Email = $email;
        return $this;
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
        $this->Name = $name;
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
     * Get Collection Location
     *
     * @access public
     * @return string
     */
    public function getCollectionLocation()
    {
        return $this->CollectionLocation;
    }
    
    /**
     * Get Contact Person
     *
     * @access public
     * @return string
     */
    public function getContactPerson()
    {
        return $this->ContactPerson;
    }

    /**
     * Get Customer Code
     *
     * @access public
     * @return string
     */
    public function getCustomerCode()
    {
        return $this->CustomerCode;
    }
    
    /**
     * Get Email Address
     *
     * @access public
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }
    
    /**
     * Get name
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }
}
