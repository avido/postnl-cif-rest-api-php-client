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
        BaseEntity
 */

use Avido\PostNLCifClient\Entities\BaseEntity;

use Avido\PostNLCifClient\Entities\Address;
use Avido\PostNLCifClient\Entities\Amount;
use Avido\PostNLCifClient\Entities\Contact;
use Avido\PostNLCifClient\Entities\Dimension;
use Avido\PostNLCifClient\Entities\Label;
use Avido\PostNLCifClient\Entities\Customs;
use Avido\PostNLCifClient\Entities\Group;
use Avido\PostNLCifClient\Entities\ProductOption;
use Avido\PostNLCifClient\Entities\Status;

use InvalidArgumentException;

class Shipment extends BaseEntity
{
    /**
     * Warnings (possible present after confirm call)
     * @var array
     */
    protected $Warnings = [];
    /**
     *List of 1 or more Address type elements. At least 1 address type is mandatory
     * @see Entities/Address
     * @var array
     */
    protected $Addresses = [];
    /**
     * Barcode of the shipment. This is a unique value
     * @var string
     */
    protected $Barcode = null;
    /**
     * One or more ContactType elements belonging to a shipment.
     * @see Entities/Contact
     * @var array
     */
    protected $Contacts = [];
    /**
     *Delivery address specification. This field is mandatory when AddressType on the Address is 09.
     * @var int
     */
    protected $DeliveryAddress = null;
    /**
     * Package Dimenions/weight
     * @see Entities/Dimension
     * @var Entities/Dimension
     */
    protected $Dimension = null;
    /**
     * Product code of the shipment
     * @var string
     */
    protected $ProductCodeDelivery = null;
    /**
     * Generate labels for shipment
     * @var array
     */
    protected $Labels = [];
    /**
     * List of 0 or more AmountType elements.
     * An amount represents a value of the shipment.
     * Amount type 01 mandatory for COD-shipments,
     * Amount type 02 mandatory for domestic insured shipments.
     * Amount type 04 mandatory for Commercial route China (productcode 4992).
     * Amount type 12 mandatory for Inco terms DDP Commercial route China (productcode 4992)
     * @see Entities/Amount
     * @var array
     */
    protected $Amounts = [];
    /**
     * Starting date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @var string
     */
    protected $CollectionTimeStampStart = null;
    /**
     * Ending date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @var string
     */
    protected $CollectionTimeStampEnd = null;
    /**
     *Content of the shipment. Mandatory for Extra@Home shipments
     * @var string
     */
    protected $Content = null;
    /**
     * Cost center of the shipment. This value will appear on your invoice
     * @var string
     */
    protected $CostCenter = null;
    /**
     * Order number of the customer
     * @var string
     */
    protected $CustomerOrderNumber = null;

    /**
     * The Customs type is mandatory for GlobalPack shipments and not allowed for any other shipment types.
     * @var Entities/Customs
     */
    protected $Customs = null;

    /**
     * The delivery date of the shipment. We strongly advice to use the DeliveryDate service to get this date
     * when using delivery options like Evening/Morning/Sameday delivery etc. For those products, this field is
     * mandatory (please regard the Guidelines section).
     * Format: dd-MM-yyyy hh:mm:ss
     * @var String
     */
    protected $DeliveryDate = null;

    /**
     * The delivery date and the specific starting time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option.
     * Format: dd-MM-yyyy hh:mm:ss
     * @var String
     */
    protected $DeliveryTimeStampStart = null;
    /**
     * The delivery date and the specific end time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option.
     * Format: dd-MM-yyyy hh:mm:ss
     * @var String
     */
    protected $DeliveryTimeStampEnd = null;
    /**
     * Barcode of the downstream network partner of PostNL Pakketten.
     * @var String
     */
    protected $DownPartnerBarcode = null;
    /**
     * Identification of the downstream network partner of PostNL Pakketten.
     * @var String
     */
    protected $DownPartnerID = null;
    /**
     * Identification of the location of the downstream network partner of PostNL Pakketten.
     * Mandatory for Pickup at PostNl Location Belgium: LD-01
     * @var String
     */
    protected $DownPartnerLocation = null;

    /**
     * List of 0 or more Group types with data, grouping multiple shipments together. Mandatory for
     * multicollo shipments.
     * @var Entities/Groups
     */
    protected $Groups = null;

    /**
     * Type of the ID document. Mandatory for ID Check products.
     *  See Products for possible values
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @var Int
     */
    protected $IDType = null;
    /**
     * Document number of the ID document. Mandatory for ID Check products
     * @var String
     */
    protected $IDNumber = null;
    /**
     * Expiration date of the ID document.
     * Mandatory for ID Check products
     * @var String
     */
    protected $IDExpiration = null;

    /**
     * Second product code of a shipment
     * @var Int
     */
    protected $ProductCodeCollect = null;

    /**
     * Product options for the shipment, mandatory for certain products, see the Products page of this webservice
     * @var Avido\PostNLCifClient\Entities\ProductOption
     */
    protected $ProductOptions = null;

    /**
     * Date of birth. Mandatory for Age check products
     * Format: d-m-Y
     * @var String
     */
    protected $ReceiverDateOfBirth = null;

    /**
     * Your own reference of the shipment. Mandatory for Extra@Home shipments; for E@H this is used to
     * create your order number, so this should be unique for each request.
     * @var String
     */
    protected $Reference = null;
    /**
     * Additional reference of the collect order of the shipment
     * @var String
     */
    protected $ReferenceCollect = null;
    /**
     * Remark of the shipment.
     * @var String
     */
    protected $Remark = null;

    /**
     * Return barcode of the shipment. Mandatory for Label in the Box (return label) shipments.
     * @var String
     */
    protected $ReturnBarcode = null;
    /**
     * Return reference of the shipment
     * @var String
     */
    protected $ReturnReference = null;

    /**
     * ID of the chosen timeslot as returned by the timeslot webservice
     * @var String
     */
    protected $TimeslotID = null;
    /**
     * Last/current status
     * @var Entities/Status
     */
    protected $Status = null;
    /**
     * Status/Eventus
     * @var array Entities/Event
     */
    protected $Event = null;
    /**
     * Status/Expectation
     * @var Entities/Expectation
     */
    protected $Expectation = null;
    /**
     * Status history
     * @var array Entities/Status
     */
    protected $OldStatus = null;

    public function __construct($data = [])
    {
        if (isset($data['Labels'])) {
            $this->setLabels($data['Labels']);
            unset($data['Labels']);
        }
        if (isset($data['Amounts'])) {
            $this->setAmounts($data['Amounts']);
            unset($data['Amounts']);
        }
        /**
         * Shipping status doesn't return as documentation stated.
         * for now don't parse
         */
//        if (isset($data['Amount'])) {
//            $this->setAmounts($data['Amount']);
//            unset($data['Amount']);
//        }
        if (isset($data['Address'])) {
            $this->setAddresses($data['Address']);
            unset($data['Address']);
        }
        if (isset($data['Status'])) {
            $this->setStatus($data['Status']);
            unset($data['Status']);
        }
        if (isset($data['Event'])) {
            $this->setEvent($data['Event']);
            unset($data['Event']);
        }
        if (isset($data['Expectation'])) {
            $this->setExpectation($data['Expectation']);
            unset($data['Expectation']);
        }
        if (isset($data['OldStatus'])) {
            $this->setOldStatus($data['OldStatus']);
            unset($data['OldStatus']);
        }
        parent::__construct($data);
    }

    /**
     * Set (last/current) Status
     *
     * @access public
     * @param array $status
     * @return $this
     */
    public function setStatus($status)
    {
        if (!$status instanceof Status) {
            $status = new Status($status);
        }
        $this->Status = $status;
        return $this;
    }

    /**
     * Get (Last/current) Status
     *
     * @access public
     * @return Entities/Status
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set OldStatus
     *
     * @access public
     * @param array $statusses
     * @return $this
     */
    public function setOldStatus($statusses)
    {
        $tmp = [];
        if (is_array($statusses)) {
            foreach ($statusses as $status) {
                if (!$status instanceof Status) {
                    $status = new Status($status);
                }
                $tmp[] = $status;
            }
            $this->OldStatus = $tmp;
        }
        return $this;
    }

    /**
     * Get OldStatus
     *
     * @access public
     * @return array Entities/Status
     */
    public function getOldStatus()
    {
        return $this->OldStatus;
    }

    /**
     * Set Status Events
     *
     * @access public
     * @param array $events
     * @return $this
     */
    public function setEvent($events)
    {
        $tmp = [];
        if (is_array($events)) {
            foreach ($events as $event) {
                if (!$event instanceof Event) {
                    $event = new Event($event);
                }
                $tmp[] = $event;
            }
        }
        $this->Event = $tmp;
        return $this;
    }

    /**
     * Get Status Events
     *
     * @access public
     * @return array Entities/Event
     */
    public function getEvent()
    {
        return $this->Event;
    }

    /**
     * Set Expectation
     *
     * @access public
     * @param array $expectation
     * @return $this
     */
    public function setExpectation($expectation)
    {
        $this->Expectation = new Expectation($expectation);
        return $this;
    }

    /**
     * Get Expectation
     *
     * @access public
     * @return Entities/Expectation
     */
    public function getExpectation()
    {
        return $this->Expectation;
    }

    /**
     * Set Amounts
     *
     * @access public
     * @param array $amounts
     */
    public function setAmounts($amounts = [])
    {
        $tmp = [];
        foreach ($amounts as $amount) {
            if (!$amount instanceof Amount) {
                $amount = new Amount($amount);
            }
            $tmp [] = $amount;
        }
        $this->Amounts = $tmp;
        return $this;
    }

    /**
     * Get Amounts
     *
     * @access public
     * @return array
     */
    public function getAmounts()
    {
        return (array)$this->Amounts;
    }

    /**
     * Set Addresses
     *
     * @access public
     * @param array $addresses
     * @return $this
     */
    public function setAddresses($addresses = [])
    {
        foreach ($addresses as $address) {
            $this->addAddress(new Address($address));
        }
        return $this;
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
     * Get Product Code for delivery
     *
     * @access public
     * @return string
     */
    public function getProductCodeDelivery()
    {
        return (string)$this->ProductCodeDelivery;
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
     * Set Array of Entities/Contact
     *
     * @access public
     * @param array $contacts
     * @return $this
     */
    public function setContacts($contacts = [])
    {
        $tmp = [];
        foreach ($contacts as $contact) {
            if (!$contact instanceof Contact) {
                $contact = new Contact($contact);
            }
            $tmp[] = $contact;
        }
        $this->Contacts = $tmp;
        return $this;
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

    public function setLabels($labels = [])
    {
        $tmp = [];
        foreach ($labels as $label) {
            if (!$label instanceof Label) {
                $label = new Label($label);
            }
            $tmp[] = $label;
        }
        $this->Labels = $tmp;
        return $this;
    }

    /**
     * Get Labels
     *
     * @access public
     * @return array
     */
    public function getLabels()
    {
        return $this->Labels;
    }

    /**
     * Set Collection Timestamp Start
     *
     * @access public
     * @param string $timestamp
     * @return $this
     */
    public function setCollectionTimestampStart($timestamp)
    {
        $this->CollectionTimeStampStart = (string)$timestamp;
        return $this;
    }

    /**
     * Get Collection Timestamp Start
     *
     * @access public
     * @return string
     */
    public function getCollectionTimestampStart()
    {
        return (string)$this->CollectionTimeStampStart;
    }


    /**
     * Set Collection Timestamp Start
     *
     * @access public
     * @param string $timestamp
     * @return $this
     */
    public function setCollectionTimestampEnd($timestamp)
    {
        $this->CollectionTimeStampEnd = (string)$timestamp;
        return $this;
    }

    /**
     * Get Collection Timestamp End
     *
     * @access public
     * @return string
     */
    public function getCollectionTimestampEnd()
    {
        return (string)$this->CollectionTimeStampEnd;
    }

    /**
     * Set contents of shipment
     *
     * @access public
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->Content = (string)$content;
        return $this;
    }

    /**
     * Get contents description of shipment
     *
     * @access public
     * @return string
     */
    public function getContent()
    {
        return (string)$this->Content;
    }

    /**
     * Set costs center
     *
     * @access public
     * @param string $cost_center
     * @return $this
     */
    public function setCostCenter($cost_center)
    {
        $this->CostCenter = (string)$cost_center;
        return $this;
    }

    /**
     * Get costs center
     *
     * @access public
     * @return string
     */
    public function getCostCenter()
    {
        return (string)$this->CostCenter;
    }

    /**
     * Set Customer Order Number
     *
     * @access public
     * @param string $order_number
     * @return $this
     */
    public function setCustomerOrderNumber($order_number)
    {
        $this->CustomerOrderNumber = (string)$order_number;
        return $this;
    }

    /**
     * Get Customer Order Number
     *
     * @access public
     * @return string
     */
    public function getCustomerOrderNumber()
    {
        return (string)$this->CustomerOrderNumber;
    }

    /**
     * Set Customs entity
     *
     * @access public
     * @param Customs $customs
     * @return $this
     */
    public function setCustoms(Customs $customs)
    {
        $this->Customs = $customs;
        return $this;
    }

    /**
     * Get Customs entity
     *
     * @access public
     * @return entities/Customs
     */
    public function getCustoms()
    {
        return $this->Customs;
    }

    /**
     * Set Delivery Date
     * Format: dd-MM-yyyy hh:mm:ss
     *
     * @access public
     * @param String $date (dd-MM-yyyy hh:mm:ss)
     * @return $this
     */
    public function setDeliveryDate($date)
    {
        if (!preg_match("/^([0-3]\d-[01]\d-[12]\d{3}\s+)[0-2]\d:[0-5]\d(:[0-5]\d)$/", $date)) {
            throw new InvalidArgumentException("Date format must be: dd-MM-yyyy hh:mm:ss");
        }
        $this->DeliveryDate = (string)$date;
        return $this;
    }

    /**
     * Get Delivery Date
     *
     * @access public
     * @return string
     */
    public function getDeliveryDate()
    {
        return (string)$this->DeliveryDate;
    }

    /**
     * Set Delivery timestamp start
     *
     * @access public
     * @param string $timestamp (Format: dd-MM-yyyy hh:mm:ss)
     * @return $this
     */
    public function setDeliveryTimeStampStart($timestamp)
    {
        if (!preg_match("/^([0-3]\d-[01]\d-[12]\d{3}\s+)[0-2]\d:[0-5]\d(:[0-5]\d)$/", $timestamp)) {
            throw new InvalidArgumentException("Date format must be: dd-MM-yyyy hh:mm:ss");
        }
        $this->DeliveryTimeStampStart = (string)$timestamp;
        return $this;
    }

    /**
     * Get Delivery Timestamp start
     *
     * @access public
     * @return string
     */
    public function getDeliveryTimeStampStart()
    {
        return (string)$this->DeliveryTimeStampStart;
    }

    /**
     * Set Delivery timestamp End
     *
     * @access public
     * @param string $timestamp (Format: dd-MM-yyyy hh:mm:ss)
     * @return $this
     */
    public function setDeliveryTimeStampEnd($timestamp)
    {
        if (!preg_match("/^([0-3]\d-[01]\d-[12]\d{3}\s+)[0-2]\d:[0-5]\d(:[0-5]\d)$/", $timestamp)) {
            throw new InvalidArgumentException("Date format must be: dd-MM-yyyy hh:mm:ss");
        }
        $this->DeliveryTimeStampEnd = (string)$timestamp;
        return $this;
    }

    /**
     * Get Delivery Timestamp end
     *
     * @access public
     * @return string
     */
    public function getDeliveryTimeStampEnd()
    {
        return (string)$this->DeliveryTimeStampEnd;
    }

    /**
     * Set DownPartnerBarcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setDownPartnerBarcode($barcode)
    {
        $this->DownPartnerBarcode = (string)$barcode;
        return $this;
    }

    /**
     * Get DownPartnerBarcode
     *
     * @access public
     * @return string
     */
    public function getDownPartnerBarcode()
    {
        return (string)$this->DownPartnerBarcode;
    }

    /**
     * Set DownPartnerID
     *
     * @access public
     * @param string $id
     * @return $this
     */
    public function setDownPartnerID($id)
    {
        $this->DownPartnerID = (string)$id;
        return $this;
    }

    /**
     * Get DownPartnerID
     *
     * @access public
     * @return string
     */
    public function getDownPartnerID()
    {
        return (string)$this->DownPartnerID;
    }

    /**
     * Set DownPartnerLocation
     *
     * @access public
     * @param string $location
     * @return $this
     */
    public function setDownPartnerLocation($location)
    {
        $this->DownPartnerLocation = (string)$location;
        return $this;
    }

    /**
     * Get DownPartnerLocation
     *
     * @access public
     * @return string
     */
    public function getDownPartnerLocation()
    {
        return (string)$this->DownPartnerLocation;
    }

    /**
     * Set Group
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\Group $group
     * @return $this
     */
    public function setGroups(Group $group)
    {
        $this->Groups = $group;
        return $this;
    }

    /**
     * Get Group
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\Group
     */
    public function getGroups()
    {
        return $this->Groups;
    }

    /**
     * Set ID Type
     *
     * @access public
     * @param int  $type
     * @return $this
     */
    public function setIDType($type)
    {
        $this->IDType = (int)$type;
        return $this;
    }

    /**
     * Get ID Type
     *
     * @access public
     * @return int
     */
    public function getIDType()
    {
        return (int)$this->IDType;
    }

    /**
     * Get IDNumber
     *
     * @access public
     * @param string $number
     * @return $this
     */
    public function setIDNumber($number)
    {
        $this->IDNumber = (string)$number;
        return $this;
    }

    /**
     * Get IDNumber
     *
     * @access public
     * @return string
     */
    public function getIDNumber()
    {
        return (string)$this->IDNumber;
    }

    /**
     * Set IDExpiration
     *
     * @access public
     * @param string $expiration (format: d-m-y)
     * @return $this
     */
    public function setIDExpiration($expiration)
    {
        if (!preg_match("/^([0-3]\d-[01]\d-[12]\d{3})$/", $expiration)) {
            throw new InvalidArgumentException("Expiration must be format: d-m-Y");
        }
        $this->IDExpiration = (string)$expiration;
        return $this;
    }

    /**
     * Get IDExpiration
     *
     * @access public
     * @return string
     */
    public function getIDExpiration()
    {
        return (string)$this->IDExpiration;
    }

    /**
     * Set ProductCodeCollect
     *
     * @access public
     * @param int $product_code
     * @return $this
     */
    public function setProductCodeCollect($product_code)
    {
        $this->ProductCodeCollect = (int)$product_code;
        return $this;
    }

    /**
     * Get ProductCodeCollect
     *
     * @access public
     * @return int
     */
    public function getProductCodeCollect()
    {
        return ($this->ProductCodeCollect > 0) ? (int)$this->ProductCodeCollect : null;
    }

    /**
     * Set ProductOptions
     *
     * @access public
     * @param Avido\PostNLCifClient\Entities\ProductOption $product_option
     * @return $this
     */
    public function setProductOptions(ProductOption $product_option)
    {
        $this->ProductOptions = $product_option;
        return $this;
    }

    /**
     * Get Product Option
     *
     * @access public
     * @return Avido\PostNLCifClient\Entities\ProductOption
     */
    public function getProductOptions()
    {
        return $this->ProductOptions;
    }

    /**
     * Set ReceiverDateOfBirth
     *
     * @access public
     * @param string $date (format: d-m-Y)
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setReceiverDateOfBirth($date)
    {
        if (!preg_match("/^([0-3]\d-[01]\d-[12]\d{3})$/", $date)) {
            throw new InvalidArgumentException("Date must be format: d-m-Y");
        }
        $this->ReceiverDateOfBirth = (string)$date;
        return $this;
    }

    /**
     * Get ReceiverDateOfBirth
     *
     * @access public
     * @return string
     */
    public function getReceiverDateOfBirth()
    {
        return (string)$this->ReceiverDateOfBirth;
    }

    /**
     * Set Reference
     *
     * @access public
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->Reference = (string)$reference;
        return $this;
    }

    /**
     * Get Reference
     *
     * @access public
     * @return string
     */
    public function getReference()
    {
        return (string)$this->Reference;
    }

    /**
     * Set ReferenceCollect
     *
     * @access public
     * @param string $reference
     * @return $this
     */
    public function setReferenceCollect($reference)
    {
        $this->ReferenceCollect = (string)$reference;
        return $this;
    }

    /**
     * Get ReferenceCollect
     *
     * @access public
     * @return string
     */
    public function getReferenceCollect()
    {
        return (string)$this->ReferenceCollect;
    }

    /**
     * Set Remark
     *
     * @access public
     * @param string $remark
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->Remark = (string)$remark;
        return $this;
    }

    /**
     * Get Remark
     *
     * @access public
     * @return string
     */
    public function getRemark()
    {
        return (string)$this->Remark;
    }

    /**
     * Set ReturnBarcode
     *
     * @access public
     * @param string $barcode
     * @return $this
     */
    public function setReturnBarcode($barcode)
    {
        $this->ReturnBarcode = (string)$barcode;
        return $this;
    }

    /**
     * Get ReturnBarcode
     *
     * @access public
     * @return string
     */
    public function getReturnBarcode()
    {
        return (string)$this->ReturnBarcode;
    }

    /**
     * Set ReturnReference
     *
     * @access public
     * @param string $reference
     * @return $this
     */
    public function setReturnReference($reference)
    {
        $this->ReturnReference = (string)$reference;
        return $this;
    }

    /**
     * Get ReturnReference
     *
     * @access public
     * @return string
     */
    public function getReturnReference()
    {
        return (string)$this->ReturnReference;
    }

    public function setTimeslotID($time_slot_id)
    {
        $this->TimeslotID = (string)$time_slot_id;
        return $this;
    }

    public function getTimeslotID()
    {
        return (string)$this->TimeslotID;
    }

    public function toArray()
    {
        $return = [
            'Addresses' => $this->getAddressesArray(),
            'Barcode' => $this->getBarcode(),
            'Contacts' => $this->getContactsArray(),
            'DeliveryAddress' => $this->getDeliveryAddress(),
            'Dimension' => $this->getDimensions()->toArray(),
            'ProductCodeDelivery' => $this->getProductCodeDelivery(),
            'CollectionTimeStampStart' => $this->getCollectionTimestampStart(),
            'CollectionTimeStampEnd' => $this->getCollectionTimestampEnd(),
            'Content' => $this->getContent(),
            'CostCenter' => $this->getCostCenter(),
            'CustomerOrderNumber' => $this->getCustomerOrderNumber(),
            'DeliveryDate' => $this->getDeliveryDate(),
            'DeliveryTimeStampStart' => $this->getDeliveryTimeStampStart(),
            'DeliveryTimeStampEnd' => $this->getDeliveryTimeStampEnd(),
            'DownPartnerBarcode' => $this->getDownPartnerBarcode(),
            'DownPartnerID' => $this->getDownPartnerID(),
            'DownPartnerLocation' => $this->getDownPartnerLocation(),
            'IDType' => $this->getIDType(),
            'IDNumber' => $this->getIDNumber(),
            'IDExpiration' => $this->getIDExpiration(),
            'ProductCodeCollect' => $this->getProductCodeCollect(),
            'ReceiverDateOfBirth' => $this->getReceiverDateOfBirth(),
            'Reference' => $this->getReference(),
            'ReferenceCollect' => $this->getReferenceCollect(),
            'Remark' => $this->getRemark(),
            'ReturnBarcode' => $this->getReturnBarcode(),
            'ReturnReference' => $this->getReturnReference(),
            'TimeslotID' => $this->getTimeslotID()
        ];
        if (!is_null($this->Customs)) {
            $return['Customs'] = $this->Customs->toArray();
        }
        if (count($this->Amounts) > 0) {
            $return['Amounts'] = $this->getAmountsArray();
        }
        if (!is_null($this->Groups)) {
            $return['Groups'] = $this->getGroups()->toArray();
        }
        if (!is_null($this->ProductOptions)) {
            $return['ProductOptions'] = $this->getProductOptions()->toArray();
        }
        return $return;
    }

    /**
     * Get Addresses array
     *
     * @access public
     * @return array
     */
    public function getAddressesArray()
    {
        $return  = [];
        foreach ($this->Addresses as $address) {
            $return[] = $address->toArray();
        }
        return $return;
    }

    /**
     * Get Contacts array
     *
     * @access public
     * @return array
     */
    public function getContactsArray()
    {
        $return = [];
        foreach ($this->Contacts as $contact) {
            $return[] = $contact->toArray();
        }
        return $return;
    }

    public function getAmountsArray()
    {
        $return = [];
        foreach ($this->Amounts as $amount) {
            $return[] = $amount->toArray();
        }
        return $return;
    }
}
