<?php
namespace Avido\PostNLCifClient;
/**
  @File: CifApiTest.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 9, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Several unit tests for the PostNL Cif Rest Api Php Client
 */

use PHPUnit\Framework\TestCase;
use Avido\PostNLCifClient\CifApi;

// exceptions
use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\CifDeliveryDateException;
use Avido\PostNLCifClient\Exceptions\CifLocationException;
use Avido\PostNLCifClient\Exceptions\CifTimeframeException;
use Avido\PostNLCifClient\Exceptions\CifConfirmingException;
use Avido\PostNLCifClient\Exceptions\CifBarcodeException;
use Avido\PostNLCifClient\Exceptions\invalidBarcodeTypeException;

// helper
use Avido\PostNLCifClient\Helper\ProductOptions;


// entities
use Avido\PostNLCifClient\Entities\Location;
use Avido\PostNLCifClient\Entities\Amount;
use Avido\PostNLCifClient\Entities\Address;
use Avido\PostNLCifClient\Entities\Shipment;
use Avido\PostNLCifClient\Entities\Customer;
use Avido\PostNLCifClient\Entities\Contact;
use Avido\PostNLCifClient\Entities\Customs;
use Avido\PostNLCifClient\Entities\CustomsContent;
use Avido\PostNLCifClient\Entities\Dimension;
use Avido\PostNLCifClient\Entities\Group;
use Avido\PostNLCifClient\Entities\ProductOption;

// locations
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsGeoRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsAreaRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\LocationRequest;
// timeframe
use Avido\PostNLCifClient\Request\DeliveryOptions\Timeframe\TimeframeRequest;
// deliverydate
use Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\DeliverydateRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\ShippingdateRequest;

// send & track
// barcode
use Avido\PostNLCifClient\Request\SendTrack\Barcode\BarcodeRequest;
// label
use Avido\PostNLCifClient\Request\SendTrack\Labelling\LabelRequest;
use Avido\PostNLCifClient\Request\SendTrack\Confirming\ConfirmRequest;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CifApiTest extends TestCase 
{

    /**
     * @var Avido\PostNLCifClient\CifApi
     */
    private $client;
    
    public function setUp()
    {
        // retrieve variables from phpunit.xml config
        $apiKey = getenv('APIKEY');
        $customerCode = getenv('CUST_CODE');
        $customerNumber = getenv('CUST_NUMBER');
        $collectionLocation = getenv('COLLECTION_LOCATION');
        
        $handler = new StreamHandler('php://stdout', Logger::DEBUG); // <<< uses a stream

        $this->client = new CifApi($apiKey, $customerNumber, $customerCode, $collectionLocation, true, $handler);
    }

    /**
     * Test Nearest Locations 
     * 
     * Nearest location instance test
     * 
     * @group location
     */
    public function testGetNearestLocationsInstance()
    {
        $request = new NearestLocationsRequest();
        $request->setCountryCode('NL')
            ->setPostalcode('2132WT')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocations($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\DeliveryOptions\Locations\NearestLocationsResponse', $response);
    }
    
    /**
     * Test Nearest Locations 
     * 
     * Retrieve nearest locations based on address information
     * 
     * @group location
     */
    public function testGetNearestLocations()
    {
        $request = new NearestLocationsRequest();
        $request->setCountryCode('NL')
            ->setPostalcode('2132WT')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocations($request);
        $this->assertTrue(count($response->getLocations()) >0);
    }
    
    /**
     * Test Nearest Locations 
     * 
     * Test exception, missing postal code
     * 
     * @group location
     */
    public function testGetNearestLocationsExceptionMissingPostalCode()
    {
        $this->expectException(CifLocationException::class);
        $request = new NearestLocationsRequest();
        $request->setCountryCode('NL')
            ->setPostalcode('')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocations($request);
    }
    
    /**
     * Test Nearest Locations Geo
     * 
     * Get nearest locations instance based on geo coordinates
     * 
     * @group location
     */
    public function testGetNearestLocationsGeoInstance()
    {
        $request = new NearestLocationsGeoRequest();
        $request->setCountryCode('NL')
            ->setLatitude('52.2864669620795')
            ->setLongitude('4.68239055845954')
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocationsGeo($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\DeliveryOptions\Locations\NearestLocationsResponse', $response);
    }
    
    /**
     * Test Nearest Locations Geo
     * 
     * Exception missing latitude
     * 
     * @group location
     */
    public function testGetNearestLocationsGeoExceptionMissingLat()
    {
        $this->expectException(CifLocationException::class);
        $request = new NearestLocationsGeoRequest();
        $request->setCountryCode('NL')
            ->setLatitude('')
            ->setLongitude('4.68239055845954')
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocationsGeo($request);
        $this->assertTrue(count($response->getLocations()) >0);
    }
    
    /**
     * Test Nearest Locations 
     * 
     * Get nearest locations based on geo coordinates
     * 
     * @group location
     */
    public function testGetNearestLocationsGeo()
    {
        $request = new NearestLocationsGeoRequest();
        $request->setCountryCode('NL')
            ->setLatitude('52.2864669620795')
            ->setLongitude('4.68239055845954')
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocationsGeo($request);
        $this->assertTrue(count($response->getLocations()) >0);
    }
  
    /**
     * Test Nearest Locations Area
     * 
     * Get nearest locations instance based on area
     * 
     * @group location
     */
    public function testGetNearestLocationsArea()
    {
        $request = new NearestLocationsAreaRequest();
        $request->setCountryCode('NL')
            ->setLatitude(['52.156439', '5.065254', '52.017473', '5.015643'])
            ->setLongitude(['52.156439', '5.065254', '52.017473', '5.015643'])
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getAPI('location')->getNearestLocationsArea($request);
        $this->assertTrue(count($response->getLocations()) >0);
    }
  

    /**
     * Test Location detail
     * 
     * Get location information based on location code and retail network id
     * 
     * @group location
     */
    public function testGetLocation()
    {
        $request = new LocationRequest();
        $request->setLocationCode('161503')
            ->setRetailNetworkId('PNPNL-01');
        $response = $this->client->getAPI('location')->getLocation($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Entities\Location', $response);
    }
  
    /**
     * Time frame test
     * 
     * Get timeframe instance
     * 
     * @group timeframe
     */
    public function testTimeframeInstance()
    {
        $request = new TimeframeRequest();
        $request->setAllowSundaySorting(false)
            ->setStartDate('25-06-2017')
            ->setEndDate('02-07-2017')
            ->setPostalCode('2132WT')
            ->setHouseNumber(42)
            ->setHouseNumberExt('a')
            ->setStreet('Siriusdreef')
            ->setCity('Hoofddorp')
            ->setCountryCode('NL')
            ->addDeliveryOption('Daytime')
            ->addDeliveryOption('Evening');
//            ->addDeliveryOption('Sameday')
//            ->addDeliveryOption('Morning');
        
        $response = $this->client->getAPI('timeframe')->getTimeframes($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\DeliveryOptions\Timeframe\TimeframesResponse', $response);
    }
    
    /**
     * Time frame test
     * 
     * Test timeframe exception
     * 
     * @group timeframe
     */
    public function testTimeframeException()
    {
        $this->expectException(CifTimeframeException::class);
        
        $request = new TimeframeRequest();
        $request->setAllowSundaySorting(false)
            ->setPostalCode('2132WT')
            ->setHouseNumber(42)
            ->setHouseNumberExt('a')
            ->setStreet('Siriusdreef')
            ->setCity('Hoofddorp')
            ->setCountryCode('NL')
            ->addDeliveryOption('Daytime')
            ->addDeliveryOption('Evening');
//            ->addDeliveryOption('Sameday')
//            ->addDeliveryOption('Morning');
        
        $response = $this->client->getAPI('timeframe')->getTimeframes($request);
    }
    
    /**
     * Time frame test
     * 
     * Get timeframes
     * 
     * @group timeframe
     */
    public function testTimeframes()
    {
        $request = new TimeframeRequest();
        $request->setAllowSundaySorting(false)
            ->setStartDate('25-06-2017')
            ->setEndDate('02-07-2017')
            ->setPostalCode('2132WT')
            ->setHouseNumber(42)
            ->setHouseNumberExt('a')
            ->setStreet('Siriusdreef')
            ->setCity('Hoofddorp')
            ->setCountryCode('NL')
            ->addDeliveryOption('Daytime')
            ->addDeliveryOption('Evening');
//            ->addDeliveryOption('Sameday')
//            ->addDeliveryOption('Morning');
        
        $response = $this->client->getAPI('timeframe')->getTimeframes($request);
        $this->assertTrue(count($response->getTimeframes()) >0);
    }
    
    /**
     * Time frame test
     * 
     * Get timeframes as array
     * 
     * @group timeframe
     */
    public function testTimeframesAsArray()
    {
        $request = new TimeframeRequest();
        $request->setAllowSundaySorting(false)
            ->setStartDate('25-06-2017')
            ->setEndDate('02-07-2017')
            ->setPostalCode('2132WT')
            ->setHouseNumber(42)
            ->setHouseNumberExt('a')
            ->setStreet('Siriusdreef')
            ->setCity('Hoofddorp')
            ->setCountryCode('NL')
            ->addDeliveryOption('Daytime')
            ->addDeliveryOption('Evening');
//            ->addDeliveryOption('Sameday')
//            ->addDeliveryOption('Morning');
        
        $response = $this->client->getAPI('timeframe')->getTimeframes($request);
        $this->assertTrue(count($response->asArray()) >0);
    }
    
    /**
     * Deliverydate test
     * 
     * Get Delivery date instance
     * 
     * @group deliverydate
     */
    
    public function testDeliveryDateInstance()
    {
        $request = new DeliverydateRequest();
        $request->setShippingDate('11-07-2018 16:00:00')
            ->setShippingDuration(1)
            ->setCutOffTime('16:00:00')
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a')
            ->addDeliveryOption('evening');
        
        $response = $this->client->getAPI('deliverydate')->getDeliveryDate($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\DeliverydateResponse', $response);
    }
    
    /**
     * Deliverydate test
     * 
     * Test Delivery date exception
     * 
     * @group deliverydate
     */
    
    public function testDeliveryDateException()
    {
        $this->expectException(CifDeliveryDateException::class);
        $request = new DeliverydateRequest();
        $request->setShippingDuration(1)
            ->setCutOffTime('16:00:00')
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a')
            ->addDeliveryOption('evening');
        
        $response = $this->client->getAPI('deliverydate')->getDeliveryDate($request);
    }
  
    /**
     * Deliverydate test
     * 
     * Get Delivery date instance
     * 
     * @group deliverydate
     */
    
    public function testDeliveryDate()
    {
        $request = new DeliverydateRequest();
        $request->setShippingDate('11-07-2018 16:00:00')
            ->setShippingDuration(1)
            ->setCutOffTime('16:00:00')
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a')
            ->addDeliveryOption('evening');
        
        $response = $this->client->getAPI('deliverydate')->getDeliveryDate($request);
        $this->assertNotNull($response->getDeliveryDate());
        
    }
    
    /**
     * Shippingdate test
     * 
     * Get Shipping date instance
     * 
     * @group deliverydate
     */
    
    public function testShippingDateInstance()
    {
        $request = new ShippingdateRequest();
        $request->setDeliveryDate('11-07-2018 16:00:00')
            ->setShippingDuration(1)
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a');
        
        $response = $this->client->getAPI('deliverydate')->getShippingDate($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\ShippingdateResponse', $response);
    }
    
    /**
     * Shippingdate test
     * 
     * Test Shipping date exception
     * 
     * @group deliverydate
     */
    
    public function testShippingDateException()
    {
        $this->expectException(CifDeliveryDateException::class);
        $request = new ShippingdateRequest();
        $request->setShippingDuration(1)
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a');
        
        $response = $this->client->getAPI('deliverydate')->getShippingDate($request);
    }
  
    /**
     * Shippingdate test
     * 
     * Get Shippingdate
     * 
     * @group deliverydate
     */
    
    public function testShippingDate()
    {
        $request = new ShippingdateRequest();
        $request->setDeliveryDate('11-07-2018 16:00:00')
            ->setShippingDuration(1)
            ->setPostalCode('1411XC')
            ->setCountryCode('NL')
            ->setOriginCountryCode('NL')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(22)
            ->setHouseNumberExt('a');
        
        $response = $this->client->getAPI('deliverydate')->getShippingDate($request);
        $this->assertNotNull($response->getShippingDate());
    }
    
    /**
     * Get Barcode Test
     *
     * @group barcode
     */
    public function testBarcode()
    {
        $type = '3S';
//        $serie = '000000000-99999999';
        // Serie will be automatically detected based on $type and $domestic 
        $serie = null; 
        $domestic = true;
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, $domestic);
        $this->assertNotNull($response->getBarcode());
        return $response->getBarcode();
    }
    
    /**
     * Get Barcode Invalid Type Exception Test
     *
     * @group barcode
     */
    public function testBarcodeException()
    {
        $this->expectException(invalidBarcodeTypeException::class);
        $type = '3Sss'; // invalid type
        $serie = null; 
        $domestic = true;
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, $domestic);
    }
    
    /**
     * Get Barcode API Exception Test
     * Raise API Exception by forcing invalid series
     *
     * @group barcode
     */
    public function testBarcodeApiException()
    {
        $this->expectException(CifBarcodeException::class);
        $type = '3S';
        $serie = 0;
        $domestic = true;
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, $domestic);
    }

    /**
     * Get Shipment Label test
     * 
     * @group label
     */
    public function testLabelRequestWithoutConfirm($barcode)
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3085;
        // test helper
        $customer = $this->getCustomerEntity();
        
        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        //sender
        $sender = Address::create()
            ->setAddressType('02')
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        
        // request barcode for shipment (depends)
//        $type = '3S';
//        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->setBarcode($barcode)
            ->addContact(Contact::create()
                ->setContactType('01')
                ->setEmail('test@test.nl')
                ->setSmsNumber('0612345678')
                ->setPhonenumber('0123456789')
            )
            ->setDimension(Dimension::create()
                ->setWeight(100) // grams
            )
            ->setProductCodeDelivery($productCodeDelivery)
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }
//        
//        // request barcode for shipment (depends)
//        $type = '3S';
//        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
////        $tmp = $barcode->getBarcode();
//        $tmp = '3STBJG274863219';
//        
//        $amounts = [];
//        // COD
//        if ($helper->isCOD()) {
//            $amounts[] = Amount::create()
//                ->setAmountType('01')
//                ->setReference('COD ref')
//                ->setCurrency('EUR')
//                ->setAccountName('Jan Janssen')
//                ->setIBAN('NL47INGB0009102236')
//                ->setTransactionNumber('1234')
//                ->setValue(120.12);
//        }
//        // INSURANCE
//        if ($helper->isExtraCover()) {
//            $amounts[] = Amount::create()
//                ->setAmountType('02')
//                ->setCurrency('EUR')
//                ->setValue(500);
//        }
//        // create shipment instance.
//        $shipment = Shipment::create()
//            ->addAddress($receiver)
////            ->setBarcode($barcode->getBarcode())
//            ->setBarcode($tmp)
//            ->addContact(Contact::create()
//                ->setContactType('01')
//                ->setEmail('test@test.nl')
//                ->setSmsNumber('0612345678')
//                ->setPhonenumber('0123456789')
//            )
//            ->setDeliveryAddress('01')
//            ->setDimension(Dimension::create()
//                ->setWeight(100) // grams
//                ->setWidth(200) // mm
//                ->setHeight(200) //mm
//                ->setLength(200) //mm
//            )
//            ->setAmounts($amounts)
//            ->setProductCodeDelivery($productCodeDelivery)
//            ->setReference('Custom reference')
//            ->setReferenceCollect('Reference collect')
//            ->setRemark('Shipment remark')
//            ->setReturnBarcode($tmp)
//            ->setReturnReference('Return reference');
//                
////            ->setProductOptions(ProductOption::create()
////                ->setCharacteristic('118')
////                ->setOption('002'));
////            ->setDeliveryDate('01-01-2018 20:00:00')
////            ->setDeliveryTimeStampStart('01-01-2018 14:00:00');
////            ->setReceiverDateOfBirth('07-04-1989');
//                // GEB DATUM DIENT GETEST TE WORDEN!!!!! ECHTER !!!!! IS LABEL IN 1 X LEEG
//        
////        $groups = Group::create()
////            ->setGroupType(Group::GROUP_TYPE_SINGLE);
////        $shipment->setGroups($groups);
////
//        
//        $printer = 'GraphicFile|PDF';
//        $response = $this->client->getAPI('labelling')->getLabel($shipment, $printer, true);
//        $this->assertNotNull($response);
//    }
    
    /**
     * Get Shipment Label Multi-Collo test
     * 
     * @group label
     */
    public function testLabelMultiColloRequestWithoutConfirm()
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3085;
        $numberOfShipments = 3;
        // get product options helper.
        $helper = ProductOptions::getProduct($productCodeDelivery);
        // test helper
        $customer = $this->getCustomerEntity();
        
        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        //sender
        $sender = Address::create()
            ->setAddressType('02')
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        
        // create mutli collo shipments.
        
        // create main barcode
        // request barcode for shipment (depends)
        $type = '3S';
        $mainBarcode = $this->client->getAPI('barcode')->getBarcode($type);
        
        for ($i=1; $i <= $numberOfShipments; $i++) {
            // create barcode for shipment.
            $barcode = $this->client->getAPI('barcode')->getBarcode('3S');
            if ($i === 1) {
                // copy barcode as main
                $mainBarcode = $barcode;
            }
            
            // create shipment instance.
            $shipment = Shipment::create()
                ->addAddress($receiver)
                ->setBarcode($barcode->getBarcode())
                ->addContact(Contact::create()
                    ->setContactType('01')
                    ->setEmail('test@test.nl')
                    ->setSmsNumber('0612345678')
                    ->setPhonenumber('0123456789')
                )
                ->setDimension(Dimension::create()
                    ->setWeight(100) // grams
                )
                ->setProductCodeDelivery($productCodeDelivery)
                ->setReference('Multi-collo ship')
                ->setRemark('Multi-collo ship remark');
            $groups = Group::create()
                ->setGroupType(Group::GROUP_TYPE_MULTI_COLLO)
                ->setGroupSequence($i)
                ->setGroupCount(3)
                ->setMainBarcode($mainBarcode->getBarcode());
            $shipment->setGroups($groups);
            $request->addShipment($shipment);
        }
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->assertTrue(count($response->getShipments()) === $numberOfShipments);
//        foreach ($response->getShipments() as $shipment) {
//            foreach ($shipment->getLabels() as $label) {
//                file_put_contents("./{$shipment->getBarcode()}.pdf", base64_decode($label->getContent()));
//            }
//        }
    }
    
    /**
     * Get Shipment Label test
     * 
     * @group labelglobalpack
     */
    public function testLabelGlobalPackRequestWithoutConfirm()
    {
        
        $productCodeDelivery = 4945;
        // get product options helper.
        $helper = ProductOptions::getProduct($productCodeDelivery);
//        $customer = Customer::create()
//            ->setCustomerCode($customer_code)
//            ->setCustomerNumber($customer_number)
//            ->setCollectionLocation($collection_location);
//        
        // create customs record.
//        CustomsContent
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Nanjinglu')
            ->setHouseNumber(137)
            ->setZipcode('310000')
            ->setCity('Shanghai')
            ->setCountrycode('CN');
        //sender
        $sender = Address::create()
            ->setAddressType('02')
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        
        // request barcode for shipment (depends)
        $type = 'CD';
        $tmp= $this->client->getAPI('barcode')->getBarcode($type, null, false)->getBarcode();
//        $tmp = '3STBJG274863219';
        $amounts = [];
        // COD
        if ($helper->isCOD()) {
            $amounts[] = Amount::create()
                ->setAmountType('01')
                ->setReference('COD ref')
                ->setCurrency('EUR')
                ->setAccountName('Jan Janssen')
                ->setIBAN('NL47INGB0009102236')
                ->setTransactionNumber('1234')
                ->setValue(120.12);
        }
        // INSURANCE
        if ($helper->isExtraCover()) {
            $amounts[] = Amount::create()
                ->setAmountType('02')
                ->setCurrency('EUR')
                ->setValue(500);
        }
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->setBarcode($tmp)
            ->addContact(Contact::create()
                ->setContactType('01')
                ->setEmail('test@test.nl')
                ->setSmsNumber('0612345678')
                ->setPhonenumber('0123456789')
            )
            ->setDeliveryAddress('01')
            ->setDimension(Dimension::create()
                ->setWeight(100) // grams
                ->setWidth(200) // mm
                ->setHeight(200) //mm
                ->setLength(200) //mm
            )
            ->setAmounts($amounts)
            ->setProductCodeDelivery($productCodeDelivery);
        
        $printer = 'GraphicFile|PDF';
        $response = $this->client->getAPI('labelling')->getLabel($shipment, $printer, true);
        foreach ($response->getShipments() as $shipment) {
            foreach ($shipment->getLabels() as $Key => $label) {
                $file = $Key . "-" . $shipment->getBarcode() . ".pdf";
                file_put_contents("./{$file}", base64_decode($label->getContent()));
            }
        }
        print_r($response->getShipments());
        exit;
    }

    private function getCustomerEntity()
    {
        $customerCode = getenv('CUST_CODE');
        $customerNumber = getenv('CUST_NUMBER');
        $collectionLocation = getenv('COLLECTION_LOCATION');
        
        $customer = Customer::create()
            ->setCustomerCode($customerCode)
            ->setCustomerNumber($customerNumber)
            ->setCollectionLocation($collectionLocation)
            ->setAddress(Address::create()
                ->setAddressType('02')
                ->setCity('Hoofddorp')
                ->setCompanyname('PostNL')
                ->setCountrycode('NL')
                ->setHousenumber(42)
                ->setHousenumberExt('A')
                ->setStreet('Siriusdreef')
                ->setZipcode('2132WT')
            )
            ->setContactPerson('Janssen')
            ->setEmail('test@test.nl')
            ->setName('Janssen');
        
        return $customer;
    }
    
    /**
     * Test shipment confirm
     * 
     * @group confirm
     */
    public function testConfirmShipment()
    {
        $productCodeDelivery = 3085;
        // test helper
        $customer = $this->getCustomerEntity();
        
        $request = new ConfirmRequest();
        $request->setCustomer($customer);
        
        $barcode = "3STBJG970139141";
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        //sender
        $sender = Address::create()
            ->setAddressType('02')
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->setBarcode($barcode)
            ->addContact(Contact::create()
                ->setContactType('01')
                ->setEmail('test@test.nl')
                ->setSmsNumber('0612345678')
                ->setPhonenumber('0123456789')
            )
            ->setDimension(Dimension::create()
                ->setWeight(100) // grams
            )
            ->setProductCodeDelivery($productCodeDelivery)
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->setShipment($shipment);
        $response = $this->client->getAPI('confirming')->confirm($request, false);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Confirming\ConfirmResponse', $response);        
    }
    
    /**
     * Test shipment confirm
     * 
     * @group confirm
     */
    public function testConfirmShipmentException()
    {
        $this->expectException(CifConfirmingException::class);
        
        $productCodeDelivery = 3085;
        // test helper
        $customer = $this->getCustomerEntity();
        
        $request = new ConfirmRequest();
        $request->setCustomer($customer);
        
        $barcode = "3STBJG970139141";
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        //sender
        $sender = Address::create()
            ->setAddressType('02')
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        
        // create shipment instance.
        $shipment = Shipment::create()
//            ->addAddress($receiver)
            ->setBarcode($barcode)
            ->addContact(Contact::create()
                ->setContactType('01')
                ->setEmail('test@test.nl')
                ->setSmsNumber('0612345678')
                ->setPhonenumber('0123456789')
            )
            ->setDimension(Dimension::create()
                ->setWeight(100) // grams
            )
            ->setProductCodeDelivery($productCodeDelivery)
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->setShipment($shipment);
        $response = $this->client->getAPI('confirming')->confirm($request, false);
    }
}
