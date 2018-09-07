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
use Avido\PostNLCifClient\Entities\LabelMessage;

class LabelRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'label';
    private $version = '2_1';

    private $printer = null;
    // body entities
    private $shipments = [];
    
            
    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        $this->arguments = [
            'confirm' => null
        ];
    }
    
    /**
     * Get Printer for PDF generation
     *
     * @access public
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/ #Printertypes
     * @param string $printer
     * @return $this
     */
    public function setPrinter($printer)
    {
        $this->printer = (string)$printer;
        return $this;
    }
    
    /**
     * Get Printer
     *
     * @access public
     * @return string
     */
    public function getPrinter()
    {
        return (string)$this->printer;
    }
    /**
     * Add Shipment
     *
     * @access public
     * @param \Avido\PostNLCifClient\Entities\Shipment $shipment
     * @return $this
     */
    public function addShipment(Shipment $shipment)
    {
        $this->shipments[] = $shipment;
        return $this;
    }
    
    public function getMessage()
    {
        $message = LabelMessage::create()
            ->setMessageId('01')
            ->setPrinterType($this->getPrinter());
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
            'Customer' => $this->getCustomer()->toArray(),
            'Message' => $this->getMessage()->toArray(),
            'Shipments' => $this->getShipmentsArray()
        ];
        $body= json_encode($body);
        return $body;
    }
    
    /**
     * Get Shipments array
     *
     * @access public
     * @return array
     */
    public function getShipmentsArray()
    {
        $return = [];
        foreach ($this->shipments as $shipment) {
            $return[] = $shipment->toArray();
        }
        return $return;
    }
}
