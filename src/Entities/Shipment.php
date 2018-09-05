<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Shipment.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Shipment Entity
  @Dependencies:
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;
use Avido\PostNLCifClient\Entities\Address;
use Avido\PostNLCifClient\Entities\Contact;
use Avido\PostNLCifClient\Entities\Dimension;

class Shipment extends BaseModel
{
    private $Addresses = [];
    private $Barcode = null;
    private $Contacts = [];
    private $DeliveryAddress = null;
    private $Dimension = null;
    private $ProductCodeDelivery = null;
    
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
    
    /**
     * Add Address
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Address $address
     * @return $this
     */
    public function addAddress(Address $address)
    {
        $this->Addresses[] = $address;
        return $this;
    }
    
    /**
     * Set Barcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setBarcode($barcode)
    {
        $this->Barcode = $barcode;
        return $this;
    }
    
    /**
     * Add Contact
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Contact $contact
     * @return $this
     */
    public function addContact(Contact $contact)
    {
        $this->Contacts[] = $contact;
        return $this;
    }
    
    /**
     * Set Delivery Address
     *
     * Delivery address specification. 
     * This field is mandatory when AddressType on the Address is 09.
     *
     * @access public
     * @param string $delivery_address
     * @return $this
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->DeliveryAddress = $delivery_address;
        return $this;
    }
    
    /**
     * Set Dimension
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Dimension $dimension
     * @return $this
     */
    public function setDimension(Dimension $dimension)
    {
        $this->Dimension = $dimension;
        return $this;
    }
    
    /**
     * Set Product Code Delivery
     *
     * @access public
     * @param string $product_code_delivery
     * @return $this
     */
    public function setProductCodeDelivery($product_code_delivery)
    {
        $this->ProductCodeDelivery = $product_code_delivery;
        return $this;
    }
    
    /**
     * Get Addresses
     *
     * @access public
     * @return array
     */
    public function getAddresses()
    {
        return (array)$this->Addresses;
    }
    
    /**
     * Get Barcode
     *
     * @access public
     * @return string
     */
    public function getBarcode()
    {
        return (string)$this->Barcode;
    }
    
    /**
     * Get Contacts
     *
     * @access public
     * @return array
     */
    public function getContacts()
    {
        return (array)$this->ContactPerson;
    }

    /**
     * Get Delivery Address Specification
     *
     * @access public
     * @return string
     */
    public function getDeliveryAddress()
    {
        return (string)$this->DeliveryAddress;
    }
    
    /**
     * Get Dimensions
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Dimension
     */
    public function getDimensions()
    {
        return $this->Dimension;
    }
    
    /**
     * Get Product Code for delivery
     *
     * @access public
     * @return string
     */
    public function getProductCodeDelivery()
    {
        return (string)$this->ProductCodeDelivery;
    }
}
