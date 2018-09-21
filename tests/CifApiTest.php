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
        Exclude tests by adding @group no-ci-test
        Several tests are excluded by default
            - Status related - these are excluded as no information is present and tests will fail
 */

use PHPUnit\Framework\TestCase;
use Avido\PostNLCifClient\CifApi;
use DateTime;

// exceptions
use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\InvalidBarcodeTypeException;

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
// label
use Avido\PostNLCifClient\Request\SendTrack\Labelling\LabelRequest;
use Avido\PostNLCifClient\Request\SendTrack\Confirming\ConfirmRequest;
// status



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
        $this->client = new CifApi(
            $apiKey, //PostNL API Key
            $customerNumber, // PostNL Customer Number
            $customerCode, // PostNL Customer Code
            $collectionLocation, // PostNL Collection Location
            true, // API Sandbox mode
            $handler // API Monolog Handler
        );
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
     * @group exceptions
     */
    public function testGetNearestLocationsExceptionMissingPostalCode()
    {
        $this->expectException(CifClientException::class);
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
     * @group exceptions
     */
    public function testGetNearestLocationsGeoExceptionMissingLat()
    {
        $this->expectException(CifClientException::class);
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
     * @group exceptions
     */
    public function testTimeframeException()
    {
        $this->expectException(CifClientException::class);
        
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
     * @group exceptions
     */
    
    public function testDeliveryDateException()
    {
        $this->expectException(CifClientException::class);
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
     * @group exceptions
     */
    
    public function testShippingDateException()
    {
        $this->expectException(CifClientException::class);
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
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, null, $domestic);
        $this->assertNotNull($response->getBarcode());
        return $response->getBarcode();
    }
    
    /**
     * Get Barcode Global Pack Test
     *
     * @group barcode
     */
    public function testBarcodeGlobalPack ()
    {
        $range = getenv('CUST_CODE_GLOBAL_PACK');
        $type = 'CD';
        $response = $this->client->getAPI('barcode')->getBarcode($type, null, $range, false);
        $this->assertNotNull($response->getBarcode());
        return $response->getBarcode();
    }
    
    /**
     * Get Barcode Invalid Type Exception Test
     *
     * @group barcode
     * @group exceptions
     */
    public function testBarcodeException()
    {
        $this->expectException(invalidBarcodeTypeException::class);
        $type = '3Sss'; // invalid type
        $serie = null; 
        $domestic = true;
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, null, $domestic);
    }
    
    /**
     * Get Barcode API Exception Test
     * Raise API Exception by forcing invalid series
     *
     * @group barcode
     * @group exceptions
     */
    public function testBarcodeApiException()
    {
        $this->expectException(CifClientException::class);
        $type = '3S';
        $serie = 0;
        $domestic = true;
        $response = $this->client->getAPI('barcode')->getBarcode($type, $serie, null, $domestic);
    }

    /**
     * Get Shipment Label test
     * 
     * @group label
     */
    public function testLabelRequestWithoutConfirm()
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
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
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }
    
    /**
     * Get Shipment Label test
     * 
     * @group labelx
     */
    public function testLabelRequestWithConfirm()
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
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
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, true);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
        // return used barcode (for shipping status tests)
        return $barcode->getBarcode();
    }
    
    /**
     * Get Shipment Label COD (Cash On Delivery) test
     * 
     * @group label
     */
    public function testLabelRequestCOD()
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3086;
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
        // amounts for COD
        $amount = Amount::create()
            ->setAmountType(Amount::TYPE_COD)
            ->setCurrency('EUR')
            ->setReference('COD ref')
            ->setAccountName('Jan Janssen')
            ->setIBAN('NL47INGB0009102236')
            ->setTransactionNumber('1234')
            ->setValue(120.12);
        
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->setBarcode($barcode->getBarcode())
            ->setAmounts([$amount])
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
        $response = $this->client->getAPI('labelling')->getLabel($request, true);
        $this->storeLabel($response);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }

    /**
     * Get Shipment Label COD (Cash On Delivery) With Extra Cover test
     * 
     * @group label
     */
    public function testLabelRequestCODExtraCover()
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3091;
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
        $amounts = [];
        
        // amounts for COD
        $amounts[] = Amount::create()
            ->setAmountType(Amount::TYPE_COD)
            ->setCurrency('EUR')
            ->setReference('COD ref')
            ->setAccountName('Jan Janssen')
            ->setIBAN('NL47INGB0009102236')
            ->setTransactionNumber('1234')
            ->setValue(120.12);
        // cover
        $amounts[] = Amount::create()
            ->setAmountType(Amount::TYPE_INSURED)
            ->setCurrency('EUR')
            ->setValue(500);
        
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->setBarcode($barcode->getBarcode())
            ->setAmounts($amounts)
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
        $response = $this->client->getAPI('labelling')->getLabel($request, true);
        $this->storeLabel($response);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }
    
    /**
     * Get Shipment Label COD (Cash On Delivery) Exception test
     * 
     * @group label
     * @group exceptions
     */
    public function testLabelRequestCODException()
    {
        $this->expectException(CifClientException::class);
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3086;
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
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
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, true);
    }
    
    /**
     * Get Shipment Label EPS (Belgium) test
     * 
     * @group label
     */
    public function testLabelRequestEpsBelgium()
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 4944;
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
            ->setStreet('Koningin Astridplein')
            ->setHouseNumber(4)
            ->setHousenumberExt('')
            ->setZipcode('2018')
            ->setCity('Antwerpen')
            ->setCountrycode('BE');
        //sender
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $barcode = $this->client->getAPI('barcode')->getBarcodeByDestination('BE');
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
            ->setReference('Ship Unit test BE')
            ->setRemark('Ship Unit test BE');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->storeLabel($response);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }    
    
    /**
     * Get Shipment Label EPS (Belgium) Exception test
     * 
     * @group label
     * @group exceptions
     */
    public function testLabelRequestEPSException()
    {
        $this->expectException(CifClientException::class);

        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 4960; // <!-- belgium domestic shipments only (we test from sender NL)
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
            ->setStreet('Koningin Astridplein')
            ->setHouseNumber(4)
            ->setHousenumberExt('')
            ->setZipcode('2018')
            ->setCity('Antwerpen')
            ->setCountrycode('BE');
        //sender
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $barcode = $this->client->getAPI('barcode')->getBarcodeByDestination('BE');
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
            ->setReference('Ship Unit test BE')
            ->setRemark('Ship Unit test BE');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
    }    
    
    /**
     * Test Label request with pickup location
     *
     * @group pickup
     */
    public function testLabelRequestPickupLocation()
    {
        $printer = 'GraphicFile|PDF';
        $productCodeDelivery = 3533;
        // test helper
        $customer = $this->getCustomerEntity();
        
        // get location for pickup.
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
        // get locations.
        $locations = $response->getLocations();
        if (count($locations) > 0) {
            $location = $locations[0];
        }
        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        
        // receiver (pickup receiver) address
        $receiver = Address::create()
            ->setAddressType(Address::RECEIVER)
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        // delivery address (pickup location)
        $deliveryAddress = Address::create()
            ->setAddressType(Address::PICKUP_LOCATION)
            ->setCompanyname($location->getName())
            ->setStreet($location->getAddress()->getStreet())
            ->setHouseNumber($location->getAddress()->getHousenumber())
            ->setHousenumberExt($location->getAddress()->getHousenumberExt())
            ->setZipcode($location->getAddress()->getZipcode())
            ->setCity($location->getAddress()->getCity())
            ->setCountrycode($location->getAddress()->getCountryCode());
        
        // sender
        $sender = $this->getSenderEntity();
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
        // create shipment instance.
        $shipment = Shipment::create()
            ->addAddress($receiver)
            ->addAddress($deliveryAddress) // pickup location
            ->setDownPartnerID($location->getRetailNetworkID())
            ->setDownPartnerLocation($location->getLocationCode())
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
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test');
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
//        $this->storeLabel($response);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }
    
    /**
     * Test Label request Evening Delivery
     *
     * @group evening
     */
    public function testLabelRequestEveningDelivery()
    {
        $printer = 'GraphicFile|PDF';
        // product code
        $productCodeDelivery = 3089;
        // evening delivery requires product option.
        $productOption = new ProductOption('evening');
        
        // test helper
        $customer = $this->getCustomerEntity();
        
        // delivery date
        $date = new DateTime();
        $date->modify('+1 weekday');

        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        
        // receiver (pickup receiver) address
        $receiver = Address::create()
            ->setAddressType(Address::RECEIVER)
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('Test Company')
            ->setStreet('Lange Heul')
            ->setHouseNumber(472)
            ->setHousenumberExt('')
            ->setZipcode('1403PA')
            ->setCity('Bussum')
            ->setCountrycode('NL');
        // sender
        $sender = $this->getSenderEntity();
        // request barcode for shipment (depends)
        $type = '3S';
        $barcode = $this->client->getAPI('barcode')->getBarcode($type);
        
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
            ->setReference('Ship Unit test')
            ->setRemark('Ship Unit test')
            ->setDeliveryDate($date->format('d-m-Y 18:00:00'))
            ->setProductOptions($productOption); // evening delivery options
        $request->addShipment($shipment);
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
//        $this->storeLabel($response);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse', $response);        
    }
    
    
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
        $sender = $this->getSenderEntity();

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
    }
    
    /**
     * Get Shipment Label test
     * 
     * @group label
     */
    public function testLabelGlobalPackRequest()
    {
        
        $productCodeDelivery = 4945;
        // get product options helper.
        $helper = ProductOptions::getProduct($productCodeDelivery);
        $customer = $this->getCustomerEntity();
        
        $printer = 'GraphicFile|PDF';
        
        // receiver address
        $receiver = Address::create()
            ->setAddressType('01')
            ->setFirstname('Henk')
            ->setName('Janssen')
            ->setCompanyname('New York Post')
            ->setStreet('Eighth Avenue')
            ->setHouseNumber(620)
            ->setZipcode('10018')
            ->setCity('New York')
            ->setCountrycode('US');
        //sender
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = 'CD';
        // update customer information for Global Pack shipment
        $customerCode = getenv('CUST_CODE_GLOBAL_PACK');
        $this->client->getAPI('barcode')->setCustomerCode($customerCode);
        
        $tmp= $this->client->getAPI('barcode')->getBarcode($type, null, false)->getBarcode();
//        $tmp = '3STBJG274863219';
        $amounts = [];
        // COD
        if ($helper->isCOD()) {
            $amounts[] = Amount::create()
                ->setAmountType(Amount::TYPE_COD)
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
        // customs 
        $customsItem = CustomsContent::create()
            ->setCountryOfOrigin('NL')
            ->setDescription('Dikke RayBan')
            ->setEAN('8053672158656')
            ->setHSTariffNr('900410') // 900410  = sunglas (see https://www.tariffnumber.com/)
            ->setQuantity(1)
            ->setValue(140.00)
            ->setWeight(125);
        $customs = Customs::create()
            ->setCurrency('EUR')
            ->setContent([$customsItem])
            ->setHandleAsNonDeliverable(false)
            ->setInvoice(true)
            ->setInvoiceNumber('RB1234-verkoop')
            ->setShipmentType(Customs::TYPE_COMMERICAL_GOODS);
        
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
            ->setProductCodeDelivery($productCodeDelivery)
            ->setCustoms($customs);
        
        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        $request->addShipment($shipment);
        
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->storeLabel($response);
        $this->assertTrue(count($response->getShipments()) === 1);
    }

    /**
     * Get Shipment Label test
     * 
     * @group label
     */
    public function testLabelGlobalPackChina()
    {
        $productCodeDelivery = 4945;
        // get product options helper.
        $helper = ProductOptions::getProduct($productCodeDelivery);
        $customer = $this->getCustomerEntity();
        
        $printer = 'GraphicFile|PDF';
        
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
        $sender = $this->getSenderEntity();
        
        // request barcode for shipment (depends)
        $type = 'CD';
        // update customer information for Global Pack shipment
        $customerCode = getenv('CUST_CODE_GLOBAL_PACK');
        $this->client->getAPI('barcode')->setCustomerCode($customerCode);
        
        $tmp= $this->client->getAPI('barcode')->getBarcode($type, null, false)->getBarcode();
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
        // customs 
        $customsItem = CustomsContent::create()
            ->setCountryOfOrigin('NL')
            ->setDescription('Dikke RayBan')
            ->setEAN('8053672158656')
            ->setHSTariffNr('900410') // 900410  = sunglas (see https://www.tariffnumber.com/)
            ->setQuantity(1)
            ->setValue(140.00)
            ->setWeight(125);
        $customs = Customs::create()
            ->setCurrency('EUR')
            ->setContent([$customsItem])
            ->setHandleAsNonDeliverable(false)
            ->setInvoice(true)
            ->setInvoiceNumber('RB1234-verkoop')
            ->setShipmentType(Customs::TYPE_COMMERICAL_GOODS);
        
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
            ->setProductCodeDelivery($productCodeDelivery)
            ->setCustoms($customs);
        
        $request = new LabelRequest();
        $request->setCustomer($customer);
        $request->setPrinter($printer);
        $request->addShipment($shipment);
        
        $response = $this->client->getAPI('labelling')->getLabel($request, false);
        $this->assertTrue(count($response->getShipments()) === 1);
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
     * @group exceptions
     */
    public function testConfirmShipmentException()
    {
        $this->expectException(CifClientException::class);
        
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
    
    /**
     * Test shipping status, current status
     * 
     * @group shippingstatus
     * @group no-ci-test
     */
    public function testShipmentCurrentStatus()
    {
        // generate barcode
        $barcode = $this->client->getAPI('barcode')->getBarcodeByDestination('NL')->getBarcode();
        $response = $this->client->getAPI('shippingstatus')->getCurrentStatus($barcode);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse', $response);
    }
    /**
     * Test Current Status By Reference
     *
     * @group shippingstatus
     * @group no-ci-test
     */
    public function testShipmentCurrentStatusByReference()
    {
        $reference = 'nodata';
        $response = $this->client->getAPI('shippingstatus')->getCurrentStatusByReference($reference);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse', $response);
    }
    /**
     * Test complete status
     *
     * @group shippingstatus
     * @group no-ci-test
     */
    public function testShipmentCompleteStatus()
    {
        $barcode = $this->client->getAPI('barcode')->getBarcodeByDestination('NL')->getBarcode();
        $response = $this->client->getAPI('shippingstatus')->getCompleteStatus($barcode);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse', $response);
    }        
    /**
     * Test Current Status By Reference
     *
     * @group shippingstatus
     * @group no-ci-test
     */
    public function testShipmentCompleteStatusByReference()
    {
        $reference = 'nodata';
        $response = $this->client->getAPI('shippingstatus')->getCompleteStatusByReference($reference);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse', $response);
    }
    
    /**
     * Test Get Signature
     *
     * @group shippingstatus
     * @group no-ci-test
     */
    public function testShipmentSignature()
    {
        $barcode = $this->client->getAPI('barcode')->getBarcodeByDestination('NL')->getBarcode();
        $response = $this->client->getAPI('shippingstatus')->getSignature($barcode);
        $this->assertInstanceOf('Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse', $response);
    }        
    
    /**
     * Sender Entitiy For REST Call
     * @return Customer 
     */
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
     * Sender Entitiy for label related api calls
     * @return Address
     */
    private function getSenderEntity()
    {
        $sender = Address::create()
            ->setAddressType(Address::SENDER)
            ->setFirstname('Henk')
            ->setName('Janssen Zender')
            ->setCompanyname('Shipment Company')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setHousenumberExt('A')
            ->setZipcode('2132WT')
            ->setCity('Hoofddorp')
            ->setCountrycode('NL');
        return $sender;
    }
    
    // tmp for viewing generated labels
    private function storeLabel($resp)
    {
        foreach ($resp->getShipments() as $shipment) {
            foreach ($shipment->getLabels() as $label) {
                file_put_contents("./{$shipment->getBarcode()}.pdf", base64_decode($label->getContent()));
            }
        }
    }
    
}
