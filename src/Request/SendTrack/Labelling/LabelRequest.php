<?php
namespace Avido\PostNLCifClient\Request\SendTrack\Labelling;

/**
    @File: LabelRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
    @copyright   Avido

    Label Request Object
    Example Post Body:
 {
  "Customer": {
    "Address": {
      "AddressType": "02",
      "City": "Hoofddorp",
      "CompanyName": "PostNL",
      "Countrycode": "NL",
      "HouseNr": "42",
      "Street": "Siriusdreef",
      "Zipcode": "2132WT"
    },
    "CollectionLocation": "1234506",
    "ContactPerson": "Janssen",
    "CustomerCode": "DEVC",
    "CustomerNumber": "11223344",
    "Email": "email@company.com",
    "Name": "Janssen"
  },
  "Message": {
    "MessageID": "1",
    "MessageTimeStamp": "29-06-2016 12:00:00",
    "Printertype": "GraphicFile|PDF"
  },
  "Shipments": {
    "Addresses": [
      {
        "AddressType": "01",
        "City": "Utrecht",
        "Countrycode": "NL",
        "FirstName": "Peter",
        "HouseNr": "9",
        "HouseNrExt": "a bis",
        "Name": "de Ruiter",
        "Street": "Bilderdijkstraat",
        "Zipcode": "3532VA"
      }
    ],
    "Barcode": "3SDEVC201611210",
    "Contacts": [
      {
        "ContactType": "01",
        "Email": "receiver@email.com",
        "SMSNr": "+31612345678",
        "TelNr": "+31301234567"
      }
    ],
    "DeliveryAddress": "01",
    "Dimension": {
      "Weight": "2000"
    },
    "ProductCodeDelivery": "3085"
  }
}
*/

use Avido\PostNLCifClient\Request\BaseRequest;
use Avido\PostNLCifClient\Entities\Address;
use Avido\PostNLCifClient\Entities\Customer;
use Avido\PostNLCifClient\Entities\Shipment;

class LabelRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'barcode';
    private $version = '1_1';

    // body entities
    private $customer = null;
    private $message = null;
    private $shipments = [];
    
            
    private $bodyEntities = [
        'Customer' => [
            'Address' => null,
            'CollectionLocation' => null,
            'ContactPerson' => null,
            'CustomerCode' => null,
            'CustomerNumber' => null,
            'Email' => null,
            'Name' => null,
        ],
        'Message' => [
            'MessageID' => null,
            'MessageTimeStamp' => null,
            'Printertype' => null
        ],
        'Shipments' => [
            'Addresses' => []
        ],
        'Barcode' => null,
        'Contacts' => [],
        'DeliveryAddress' => null,
        'Dimension' => null,
        'ProductCodeDelivery' => null
    ];
    
    private $address = null;
    
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'confirm' => null
        ];
    }
    
    
    /**
     * Set Address
     *
     * @access public
     * @param \Avido\PostNLCifClient\Entities\Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }
    
    /**
     * Set Customer 
     *
     * @access public
     * @param \Avido\PostNLCifClient\Entities\Customer $customer
     * @return $this
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }
    
    /**
     * Set Customer Code
     *
     * Customer code as known at PostNL Pakketten
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode($customer_code)
    {
        $this->arguments['customer_code'] = $customer_code;
        return $this;
    }
    
    /**
     * Set Customer Number
     *
     * Customer number as known at PostNL Pakketten
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->arguments['customer_number'] = $customer_number;
        return $this;
    }
    
    /**
     * Set Type of barcode
     *
     * Accepted values: 2S, 3S, CC, CP, CD, CF 
     * see documention page for more detailed information
     *
     * @access public
     * @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/documentation-soap/
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->arguments['type'] = $type;
        return $this;
    }
    
    /**
     * Set Barcode Serie
     *
     * Barcode serie in the format '###000000-###000000’, for example 100000-20000. The range must 
     * consist of a minimal difference of 100.000. Minimum length of the serie is 6 characters; maximum 
     * length is 9 characters. It is allowed to add extra leading zeros at the beginning of the serie. 
     * See Guidelines for more information.
     *
     * @access public
     * @param string $serie
     * @return $this
     */
    public function setSerie($serie)
    {
        $this->arguments['serie'] = $serie;
        return $this;
    }
}
