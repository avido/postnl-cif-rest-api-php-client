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
use Avido\PostNLCifClient\Exceptions\CifClientException;

// entities
use Avido\PostNLCifClient\Entities\Location;

// locations
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsGeoRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsAreaRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\LocationRequest;


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
        $this->assertTrue(count($response->getLocations()) >0);
    }
    
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
  

    public function testGetLocation()
    {
        $request = new LocationRequest();
        $request->setLocationCode('161503')
            ->setRetailNetworkId('PNPNL-01');
        $response = $this->client->getAPI('location')->getLocation($request);
        $this->assertInstanceOf('Avido\PostNLCifClient\Entities\Location', $response);
    }
  
    
}
