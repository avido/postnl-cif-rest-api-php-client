<?php
namespace Avido\PostNLCifClient\Request\SendTrack\Confirming;

/**
    @File: ConfirmingRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/send-and-track/confirming-webservice/
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
use Avido\PostNLCifClient\Entities\Message;

class ConfirmRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'confirm';
    private $version = '1_10';

    private $printer = null;
    private $shipment = null;
    
            
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
    }
    
    /**
     * Check for mandatory elements
     *
     * @access public
     * @return boolean
     */
    public function okay()
    {
        if (is_null($this->customer)) {
            return false;
        }
        if (is_null($this->shipment)) {
            return false;
        }
        return true;
    }
    /**
     * Set Shipment
     *
     * @access public
     * @param \Avido\PostNLCifClient\Entities\Shipment $shipment
     * @return $this
     */
    public function setShipment(Shipment $shipment)
    {
        $this->shipment = $shipment;
        return $this;
    }
    /**
     * Get Shipment
     *
     * @access public
     * @return \Avido\PostNLCifClient\Entities\Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }
    
    public function getMessage()
    {
        $message = Message::create()
            ->setMessageId('01');
        return $message;
    }
    /**
     * Get Label Request Json encoded body
     *
     * @access public
     * @return string
     */
    public function getBody()
    {
        $body = [
            'Customer' => !is_null($this->getCustomer()) ? $this->getCustomer()->toArray() : null,
            'Message' => !is_null($this->getMessage()) ? $this->getMessage()->toArray() : null,
            'Shipments' => !is_null($this->getShipment()) ? [$this->getShipment()->toArray()] : []
        ];
        $body= json_encode($body);
        return $body;
    }
}
