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

// entities
use Avido\PostNLCifClient\Entities\Location;

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


class CifApiTest extends TestCase 
{

    /**
     * @var Avido\PostNLCifClient\CifApi
     */
    private $client;
    
    public function setUp()
    {
        // retrieve username from phpunit.xml config
        $apiKey = getenv('APIKEY');
        
        $this->client = new CifApi($apiKey, true);
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
    
}
